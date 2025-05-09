<?php
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::prefix('notes')->group(function () {
    Route::get('/{alias}', [NoteController::class, 'show'])->name('notes.show');
    Route::middleware('cors')->get('/{alias}/count', [NoteController::class, 'count']);
});
Route::get('/note/{alias}', [NoteController::class, 'show'])->name('note.show');
