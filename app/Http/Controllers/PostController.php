<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;
use App\Models\Difficulty;
use App\Models\User;
use App\Http\Requests\PostRequest;
use App\Models\Reply;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Tag;
use Cloudinary;

class PostController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
    
    //投稿一覧
    public function index(Post $post, Request $request)
    {
        // 検索用
        $category = new Category;
        $categories = $category->getLists();
        $difficulty = new Difficulty;
        $difficulties = $difficulty->getLists();
        $tag = $request->input('tag');
        $searchWord = $request->input('searchWord');
        $categoryId = $request->input('categoryId');
        $difficultyId = $request->input('difficultyId');
        // いいね用
        $user = auth()->user();
        // $posts = Post::withCount('likes')->orderByDesc('updated_at')->get();
        
        return view('posts.index')->with([
            // 検索用
            'posts' => $post->getPaginateByLimit(),
            'categories' => $categories,
            'difficulties' => $difficulties,
            'tag' => $tag,
            'searchWord' => $searchWord,
            'categoryId' => $categoryId,
            'difficultyId' => $difficultyId,
            // いいね用
            // 'posts' => $posts,
        ]);
    }
    
    //投稿詳細
    public function show(Post $post, Reply $reply)
    {
        return view('posts.show')->with([
            'post' => $post,
            'replies' => $post->replies()->get(),
            // 'replies' => $reply->getReplies(),
        ]);
    }
    //新規投稿作成画面
    public function create(Category $category,  Difficulty $difficulty, User $user)
    {
        return view('posts.create')->with([
            'categories' => $category->get(),
            'difficulties' => $difficulty->get(),
        ]);
    }
    //投稿をDBに保存して投稿一覧へリダイレクト
    public function store(PostRequest $request, Post $post)
    {
        $post = new Post();
        //画像の保存
        if($image = $request->file('image')){
            //Cloudinaryに画像をアップロードしてURLを取得
            $post->public_id = Cloudinary::upload($request->file('image')->getRealPath(),['folder' => 'images'])->getSecurePath();
            $post->main_img = Cloudinary::upload($request->file('image')->getRealPath(),['folder' => 'images',
                'crop' => 'crop',
                'width' => 720,
                'height' => 400,
                'gravity' => 'auto', ])->getSecurePath();
        }
        $input = $request['post'];
        $post->user_id = Auth::id();
        $post->fill($input)->save();
        //ハッシュタグの保存
        $post_body = $post->body;
        $tags = [];
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $post_body, $tags);//正規表現を用いてハッシュタグを見つけて配列($tags)に入れる。
        foreach ($tags[1] as $tag) {
            $tag = ltrim($tag, '#'); //先頭の`#`を削除。
            $tag = Tag::firstOrCreate(['name' => $tag]); //すでにtagテーブルにある場合はfirst、なければcreateする。
            $post->tags()->attach($tag); //postと紐づけて保存。
            // 投稿ににタグ付するために、attachメソッドをつかい、モデルを結びつけている中間テーブルにレコードを挿入
        }

        return redirect('/posts/' . $post->id);
    }
    // 投稿削除
    public function delete(Post $post)
    {
        // Cloudinary上の画像を削除する
        if(isset($post->public_id)){
            Cloudinary::destroy($post->public_id);
            Cloudinary::destroy($post->main_img);
        }
        $post->delete();
        return redirect('/user-prof/prof');
    }
    //検索メソッド
    public function search(Request $request)
    {
        // 入力される値
        $tag = $request->input('tag');//ハッシュタグの値
        $searchWord = $request->input('searchWord');//タイトルの値
        $categoryId = $request->input('categoryId');//カテゴリの値
        $difficultyId = $request->input('difficultyId');//難易度の値
        
        $query = Post::query();
        // 入力されたハッシュタグを持つ投稿を$queryに代入
        if(isset($tag)) {
            // postsテーブルとリレーションを持つtagsテーブルのnameカラムに対して曖昧検索をする
            $query = Post::whereHas('tags', function ($query) use ($tag) {
                $query->where('name', 'like', '%' . $tag . '%');
            });
        }
        //入力された時postsテーブルから一致する投稿を$queryに代入
        if(isset($searchWord)) {
            $query->where('title', 'like', '%' . self::escapeLike($searchWord) . '%');
        }
        // カテゴリが選択された場合Categoriesテーブルからcategory_idが一致する投稿を$queryに代入
        if(isset($categoryId)) {
            $query->where('category_id', $categoryId);
        }
        // 難易度が選択された場合Difficultiesテーブルからdifficulty_idが一致する投稿を$queryに代入
        if(isset($difficultyId)) {
            $query->where('difficulty_id', $difficultyId);
        }
        
        // $queryをcategory_idの昇順に並び替えて$postsに代入
        $posts = $query->orderBy('category_id', 'ASC')->paginate(15);
        
        // CategoriesテーブルからgetLists();関数でcategory_idとnameを取得
        $category = new Category;
        $categories = $category->getLists();
        
        // DifficultiesテーブルからgetLists();関数でdifficulty_idとnameを取得
        $difficulty = new Difficulty;
        $difficulties = $difficulty->getLists();
        
        return view('posts.index')->with([
            'posts' => $posts,
            'categories' => $categories,
            'difficulties' => $difficulties,
            'tag' => $tag,
            'searchWord' => $searchWord,
            'categoryId' => $categoryId,
            'difficultyId' => $difficultyId,
        ]);
    }
    
    // エスケープ処理
    public static function escapeLike($str)
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
    }
    
    public function like(Request $request)
    {
        $user_id = Auth::user()->id; // ログインしているユーザーのidを取得
        $post_id = $request->post_id; // 投稿のidを取得
    
        // すでにいいねがされているか判定するためにlikesテーブルから1件取得
        $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); 
    
        if (!$already_liked) { 
            $like = new Like; // Likeクラスのインスタンスを作成
            $like->post_id = $post_id;
            $like->user_id = $user_id;
            $like->save();
        } else {
            // 既にいいねしてたらdelete 
            Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }
        // 投稿のいいね数を取得
        $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;
        $param = [
            'post_likes_count' => $post_likes_count,
        ];
        return response()->json($param); // JSONデータをjQueryに返す
    }
}
