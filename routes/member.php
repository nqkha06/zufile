<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Member\WithdrawController;
use App\Http\Controllers\Member\ProfileController;
use App\Http\Controllers\Member\PaymentController;
use App\Http\Controllers\Member\ChangePasswordController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\FileController;
use App\Http\Controllers\Member\LeaderboardController;
use App\Http\Controllers\Member\PayoutRateController;
use App\Http\Controllers\Member\STUController;
use App\Http\Controllers\Member\NOTEController;
use App\Http\Controllers\Member\ReferralController;
use App\Http\Controllers\Member\ToolControler;
use App\Http\Controllers\Member\NotePayoutRateController;
use App\Http\Controllers\Member\FolderController;
use App\Http\Controllers\Member\UController;
use App\Http\Controllers\Member\AccountController;
use App\Http\Controllers\Member\SupportController;
use App\Http\Controllers\Member\StatisticController;
use App\Http\Controllers\Member\TrashController;
use App\Http\Controllers\Member\UpgradeController;
use App\Http\Controllers\PlanController;

Route::middleware(['auth'])->prefix('u')->group(function () {
    Route::get('folders', [UController::class, 'index'])->name('member.u.folders');
    Route::post('folders', [UController::class, 'createFolder'])->name('u.folders.create');
    Route::post('folders/{alias}', [UController::class, 'updateFolder'])->name('u.folders.update');
    Route::delete('folders/{alias}', [UController::class, 'deleteFolder'])->name('u.folders.delete');

    Route::get('files', [UController::class, 'files'])->name('u.files');
    Route::post('files/{alias}', [UController::class, 'update'])->name('u.files.update');
    Route::delete('files/{alias}', [FileController::class, 'destroy'])->name('u.files.destroy');
    Route::get('drive/1/home', [FileController::class, 'index'])->name('u.files.home');
    Route::get('drive/search', [FileController::class, 'search'])->name('u.files.search');
    Route::get('/trash', [TrashController::class, 'index'])->name('u.trash');
    Route::delete('/trash', [TrashController::class, 'emptyTrash'])->name('u.trash.emptyTrash');

    Route::post('trash/{alias}', [TrashController::class, 'update'])->name('u.trash.update');
    Route::delete('trash/{alias}', [TrashController::class, 'destroy'])->name('u.trash.destroy');

    Route::get('drive/1/{alias}', [UController::class, 'detail'])->name('u.files.show');
    Route::get('/referrals', [ReferralController::class, 'index'])->name('u.referrals');

    Route::get('/statistics', [StatisticController::class, 'index'])->name('u.statistics');
    Route::get('/withdraw', [WithdrawController::class, 'index'])->name('u.withdraw');
    Route::post('/withdraw', [WithdrawController::class, 'store'])->name('u.withdraw.store');

    Route::get('/account', [AccountController::class, 'index'])->name('u.account');
    Route::post('/account', [AccountController::class, 'update'])->name('u.account.update');
    Route::post('/account/change-password', [ChangePasswordController::class, 'update']);

    Route::put('/payment', [PaymentController::class, 'update'])->name('u.payment.update');

    Route::get('/support', [SupportController::class, 'index'])->name('u.support');

    // Plan Management Routes
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::post('/plans/{plan}/upgrade', [PlanController::class, 'upgrade'])->name('plans.upgrade');
    Route::post('/plans/renew', [PlanController::class, 'renew'])->name('plans.renew');
    Route::post('/plans/downgrade', [PlanController::class, 'downgrade'])->name('plans.downgrade');
    Route::get('/plan/status', [PlanController::class, 'status'])->name('plan.status');
});
