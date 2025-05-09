<?php

use App\Http\Controllers\Fontend\PostController;

use App\Http\Controllers\Member\DashboardController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Fontend\BlogController;
use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

Route::get('lang/{language}', function ($locale) {
    if (!in_array($locale, getAllLanguages()->pluck('code')->toArray() ?? [])) {
        abort(404);
    }
    session()->put('locale', $locale);
    return redirect()->back();
})->name('lang.switcher');

/* API ROUTE */
require __DIR__.'/apii.php';

/* FONTEND */
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('blog.article');
Route::get('/blog/categories/{slug}', [BlogController::class, 'showCategory'])->name('blog.category');

/* PAGE */
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('blog.page');

/* ADMIN ROUTE */
require __DIR__.'/admin.php';

/* MEMBER ROUTE */
require __DIR__.'/member.php';

/* note route */
require __DIR__.'/note.php';

/* stu route */
require __DIR__.'/stu.php';

/* auth route */
require __DIR__.'/auth.php';

Route::post('ckeditor/upload', [DashboardController::class, 'upload'])->name('ckeditor.upload');