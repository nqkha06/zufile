<?php

use App\Http\Controllers\Fontend\PostController;

use App\Http\Controllers\Member\DashboardController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Fontend\BlogController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Link4SubDzController;
use App\Http\Controllers\UploadCtl;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DownloadController;
Route::get('lang/{language}', function ($locale) {
    if (!in_array($locale, getAllLanguages()->pluck('code')->toArray() ?? [])) {
        abort(404);
    }
    session()->put('locale', $locale);
    return redirect()->back();
})->name('lang.switcher');


/* FONTEND */
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/payment-proof', [HomeController::class, 'paymentProof'])->name('home.payment-proof');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('blog.article');
Route::get('/blog/categories/{slug}', [BlogController::class, 'showCategory'])->name('blog.category');

Route::view('report', 'clients.report')->name('report');
Route::get('/report/{alias}', function ($alias) {
    return view('clients.report', ['alias' => $alias]);
})->name('report.alias');
Route::post('/report', [UploadCtl::class, 'store'])->name('report.store');

/* PAGE */
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('blog.page');
Route::post('/link4sub_dz', [Link4SubDzController::class, 'store'])->name('l4s.dz');

Route::post('/upload-wasabi', [UploadController::class, 'uploadToWasabi']);
Route::view('/upload', 'upload');

/* ADMIN ROUTE */
require __DIR__.'/admin.php';

/* MEMBER ROUTE */
require __DIR__.'/member.php';

/* auth route */
require __DIR__.'/auth.php';

Route::get('/download/{alias}', [DownloadController::class, 'index'])->name('download.index');
Route::post('/download/{alias}', [DownloadController::class, 'download'])->name('download.file');
Route::post('/download/{alias}/verify-captcha', [DownloadController::class, 'verifyCaptcha'])->name('download.verify-captcha');
Route::post('/download/{alias}/event', [DownloadController::class, 'event'])->name('download.event');
Route::post('ckeditor/upload', [DashboardController::class, 'upload'])->name('ckeditor.upload');
