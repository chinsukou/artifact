<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Difficulty;

class DifficultyController extends Controller
{
    public function index(Difficulty $difficulty)
    {
        return view('difficulties.index')->with([
            'posts' => $difficulty->getByDifficulty()
        ]); 
    }
}
