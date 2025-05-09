<?php
use App\Http\Controllers\StuController;
use Illuminate\Support\Facades\Route;

Route::get('/{alias}', [StuController::class, 'redirect'])->where('alias', '[A-Za-z0-9]{4}')->name('stu.show');
// Route::get('/check-proxy', [StuController::class, 'checkProxyVpn'])->name('stu.checkProxyVpn');

Route::get('/dc-1', function (){
    return view('fontend.stu.dc_1');
})->name('stu.decode_1');
Route::get('/dc-2', function (){
    return view('fontend.stu.dc_2');
})->name('stu.decode_2');
Route::get('/redirect', function (){
    return view('fontend.stu.redirect');
})->name('stu.redirect');

Route::prefix('stu')->group(function () {
    Route::post('/', [StuController::class, 'create']);
    Route::put('/{alias}', [StuController::class, 'update']);
    Route::delete('/{alias}', [StuController::class, 'delete']);
    Route::get('/{alias}/fetch-data', [StuController::class, 'fetch']);
    Route::middleware('cors')->get('/{alias}/count', [StuController::class, 'count'])->where('alias', '[A-Za-z0-9]{4}')->name('stu.count');
});