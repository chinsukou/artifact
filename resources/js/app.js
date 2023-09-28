import './bootstrap';
import './_ajaxlike';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// 検索フォームの表示・非表示
document.addEventListener('DOMContentLoaded', function () {
    const searchIcon = document.getElementById('searchIcon');
    const searchForm = document.getElementById('searchForm');

    searchIcon.addEventListener('click', function () {
        if (searchForm.style.display === 'block') {
            searchForm.style.display = 'none';
        } else {
            searchForm.style.display = 'block';
        }
    });
});