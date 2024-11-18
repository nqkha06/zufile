<?php
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::prefix('note')->group(function () {
    Route::post('/', [NoteController::class, 'create']);
    Route::post('/{alias}/update', [NoteController::class, 'update']);
    Route::get('/{alias}', [NoteController::class, 'show'])->name('note.show');
    Route::middleware('cors')->get('/{alias}/count', [NoteController::class, 'count']);
});