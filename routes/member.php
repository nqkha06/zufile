
<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Member\WithdrawController;
use App\Http\Controllers\Member\ProfileController;
use App\Http\Controllers\Member\PaymentController;
use App\Http\Controllers\Member\ChangePasswordController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\LeaderboardController;
use App\Http\Controllers\Member\PayoutRateController;
use App\Http\Controllers\Member\STUController;
use App\Http\Controllers\Member\NOTEController;
use App\Http\Controllers\Member\ReferralController;

Route::middleware(['auth', 'user_metric'])->prefix('member')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('member.index');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('member.dashboard.index');
    Route::get('/payout-rates', [PayoutRateController::class, 'index'])->name('member.payout_rates');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('member.leaderboard');
    Route::get('/stu-links', [STUController::class, 'index'])->name('member.stu_links');
    Route::delete('/stu-links/{alias}', [STUController::class, 'destroy'])->name('member.stu.destroy');
    Route::get('/referral', [ReferralController::class, 'index'])->name('member.referral');

    Route::get('/note-links', [NOTEController::class, 'index'])->name('member.note_links');
    Route::delete('/note-links/{alias}', [NOTEController::class, 'destroy'])->name('member.note.destroy');

    Route::post('/notes', [App\Http\Controllers\NoteController::class, 'create'])->name('member.notes.create');
    Route::put('/notes/{alias}/update', [App\Http\Controllers\NoteController::class, 'update'])->name('member.notes.update');

    // Route::get('/api-tokens', [DashboardController::class, 'apiTokens'])->name('user.api.tokens');
    // Route::get('/quick-link', [DashboardController::class, 'quickLink'])->name('user.quick.link');
    Route::get('/withdraw', [WithdrawController::class, 'index'])->name('member.withdraw.index');
    Route::post('/withdraw', [WithdrawController::class, 'store']);

    Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('member.change_password');
    Route::post('/change-password', [ChangePasswordController::class, 'update']);
    Route::get('/profile', [ProfileController::class, 'index'])->name('member.profile.index');
    Route::post('/profile', [ProfileController::class, 'update']);

    Route::get('/payment', [PaymentController::class, 'index'])->name('member.payment.index');
    Route::put('/payment', [PaymentController::class, 'update'])->name('member.payment.update');
});