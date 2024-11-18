<?php
use App\Http\Controllers\ToolController;
use Illuminate\Support\Facades\Route;

Route::get('/geoip/{ip}', [ToolController::class, 'geoIP'])->name('geoip');

