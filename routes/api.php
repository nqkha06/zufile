<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadCtl;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['web', 'auth'])->prefix('upload')->group(function () {
    Route::post ('init',     [UploadCtl::class,'init']);
    Route::post ('complete', [UploadCtl::class,'complete']);
    Route::post ('cancel',   [UploadCtl::class,'cancel']);
});
