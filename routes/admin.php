<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GeneralController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NOTELevelController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SendEmailController;
use App\Http\Controllers\Admin\TopUserController;
use App\Http\Controllers\Admin\PermissionGroupController;
use App\Http\Controllers\Admin\STUController;
use App\Http\Controllers\Admin\WidgetController;

Route::prefix('admin')->middleware(['role:admin|super-admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.index');
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::prefix('note')->group( function () {
        Route::get('/', [App\Http\Controllers\Admin\NOTEController::class, 'index'])->name('admin.note.index');
        Route::get('/{id}', [App\Http\Controllers\Admin\NOTEController::class, 'show'])->name('admin.note.show');
        Route::put('/{alias}/restore', [App\Http\Controllers\Admin\NOTEController::class, 'restore'])->name('admin.note.restore');
        Route::delete('/{alias}/soft-delete', [App\Http\Controllers\Admin\NOTEController::class, 'softDelete'])->name('admin.note.softDelete');
    });

    Route::prefix('stu')->group( function () {
        Route::get('/', [App\Http\Controllers\Admin\STUController::class, 'index'])->name('admin.stu.index');
        Route::get('/{id}', [App\Http\Controllers\Admin\STUController::class, 'show'])->name('admin.stu.show');
        Route::put('/{alias}/restore', [App\Http\Controllers\Admin\STUController::class, 'restore'])->name('admin.stu.restore');
        Route::delete('/{alias}/soft-delete', [App\Http\Controllers\Admin\STUController::class, 'softDelete'])->name('admin.stu.softDelete');
    });

    Route::prefix('invoices')->group( function () {
        Route::get('/', [App\Http\Controllers\Admin\InvoiceController::class, 'index'])->name('admin.invoices.index');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\InvoiceController::class, 'edit'])->name('admin.invoices.edit');
        Route::get('/{id}/pay', [App\Http\Controllers\Admin\InvoiceController::class, 'pay'])->name('admin.invoices.pay');
        Route::put('/{id}', [App\Http\Controllers\Admin\InvoiceController::class, 'update'])->name('admin.invoices.update');
        Route::get('/{id}/pending', [App\Http\Controllers\Admin\InvoiceController::class, 'pending'])->name('admin.invoices.pending');
        Route::get('/{id}/watched', [App\Http\Controllers\Admin\InvoiceController::class, 'watched'])->name('admin.invoices.watched');
        Route::get('/{id}/success', [App\Http\Controllers\Admin\InvoiceController::class, 'success'])->name('admin.invoices.success');
        Route::get('/{id}/refuse', [App\Http\Controllers\Admin\InvoiceController::class, 'refuse'])->name('admin.invoices.refuse');
        Route::get('/{id}/contact', [App\Http\Controllers\Admin\InvoiceController::class, 'contact'])->name('admin.invoices.contact');    
    });
    Route::prefix('stats')->group( function () {
        Route::get('/access', [App\Http\Controllers\Admin\AccessController::class, 'index'])->name('admin.access.index');
        Route::get('/level', [App\Http\Controllers\Admin\StatController::class, 'level'])->name('admin.stats.level');
    });

    Route::prefix('users')->group( function () {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
        Route::get('/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
        Route::post('/', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
        Route::get('/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.users.show');
    });

    Route::prefix('roles')->group( function () {
        Route::get('/', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.roles.index');
        Route::post('/', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('admin.roles.store');
        Route::get('/{id}/give-permissions', [App\Http\Controllers\Admin\RoleController::class, 'add'])->name('admin.roles.add');
        Route::put('/{id}/give-permissions', [App\Http\Controllers\Admin\RoleController::class, 'give'])->name('admin.roles.give');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('admin.roles.edit');
        Route::put('/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('admin.roles.update');
        Route::get('/{id}/delete', [App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('admin.roles.destroy');
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('admin.permissions.index');
        Route::post('/', [App\Http\Controllers\Admin\PermissionController::class, 'store'])->name('admin.permissions.store');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\PermissionController::class, 'edit'])->name('admin.permissions.edit');
        Route::put('/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('admin.permissions.update');
        Route::get('/{id}/delete', [App\Http\Controllers\Admin\PermissionController::class, 'destroy'])->name('admin.permissions.destroy');    
    });

    Route::prefix('permission-group')->group(function () {
        Route::get('/', [PermissionGroupController::class, 'index'])->name('admin.permission-groups.index');
        Route::get('/create', [PermissionGroupController::class, 'create'])->name('admin.permission-groups.create');
        Route::post('/', [PermissionGroupController::class, 'store'])->name('admin.permission-groups.store');
        Route::get('/{permissionGroup}/edit', [PermissionGroupController::class, 'edit'])->name('admin.permission-groups.edit');
        Route::put('/{permissionGroup}', [PermissionGroupController::class, 'update'])->name('admin.permission-groups.update');
        Route::delete('permission-groups/{permissionGroup}', [PermissionGroupController::class, 'destroy'])->name('admin.permission-groups.destroy');
    });

    Route::get('/general', [GeneralController::class, 'index'])->name('admin.general.index');
    Route::post('/general', [GeneralController::class, 'update'])->name('admin.general.update');

    Route::prefix('levels')->group( function () {
        Route::get('/', [LevelController::class, 'index'])->name('admin.levels.index');
        Route::get('/create', [LevelController::class, 'create'])->name('admin.levels.create');
        Route::post('/store', [LevelController::class, 'store'])->name('admin.levels.store');
        Route::get('/{id}/edit', [LevelController::class, 'edit'])->name('admin.levels.edit');
        Route::put('/{id}', [LevelController::class, 'update'])->name('admin.levels.update');
        Route::get('/{id}/config', [LevelController::class, 'editConfig'])->name('admin.levels.editConfig');
        Route::put('/{id}/config', [LevelController::class, 'updateConfig'])->name('admin.levels.updateConfig');
        Route::get('/{id}/pageload', [LevelController::class, 'editPageload'])->name('admin.levels.editPageload');
        Route::put('/{id}/pageload', [LevelController::class, 'updatePageload'])->name('admin.levels.updatePageload');
    });
    Route::prefix('note-levels')->group( function () {
        Route::get('/', [NOTELevelController::class, 'index'])->name('admin.note_levels.index');
        Route::get('/create', [NOTELevelController::class, 'create'])->name('admin.note_levels.create');
        Route::post('/store', [NOTELevelController::class, 'store'])->name('admin.note_levels.store');
        Route::get('/{id}/edit', [NOTELevelController::class, 'edit'])->name('admin.note_levels.edit');
        Route::put('/{id}', [NOTELevelController::class, 'update'])->name('admin.note_levels.update');
        Route::get('/{id}/config', [NOTELevelController::class, 'editConfig'])->name('admin.note_levels.editConfig');
        Route::put('/{id}/config', [NOTELevelController::class, 'updateConfig'])->name('admin.note_levels.updateConfig');
        Route::get('/{id}/pageload', [NOTELevelController::class, 'editPageload'])->name('admin.note_levels.editPageload');
        Route::put('/{id}/pageload', [NOTELevelController::class, 'updatePageload'])->name('admin.note_levels.updatePageload');
    });

    Route::prefix('payment-methods')->group( function () {
        Route::get('/', [App\Http\Controllers\Admin\PaymentMethodController::class, 'index'])->name('admin.payment-methods.index');
        Route::get('/create', [App\Http\Controllers\Admin\PaymentMethodController::class, 'create'])->name('admin.payment-methods.create');
        Route::post('/store', [App\Http\Controllers\Admin\PaymentMethodController::class, 'store'])->name('admin.payment-methods.store');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\PaymentMethodController::class, 'edit'])->name('admin.payment-methods.edit');
        Route::put('/{id}', [App\Http\Controllers\Admin\PaymentMethodController::class, 'update'])->name('admin.payment-methods.update');
    
    });

    Route::prefix('categories')->group( function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });

    Route::prefix('posts')->group( function () {
        Route::get('/', [PostController::class, 'index'])->name('admin.posts.index');
        Route::post('/', [PostController::class, 'store'])->name('admin.posts.store');
        Route::get('/create', [PostController::class, 'create'])->name('admin.posts.create');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
        Route::put('/{id}', [PostController::class, 'update'])->name('admin.posts.update');
        Route::delete('/{id}/delete', [PostController::class, 'destroy'])->name('admin.posts.destroy');
    });

    Route::prefix('pages')->group( function () {
        Route::get('/', [PageController::class, 'index'])->name('admin.pages.index');
        Route::get('/create', [PageController::class, 'create'])->name('admin.pages.create');
        Route::post('/', [PageController::class, 'store'])->name('admin.pages.store');
        Route::get('/{id}/edit', [PageController::class, 'edit'])->name('admin.pages.edit');
        Route::put('/{id}', [PageController::class, 'update'])->name('admin.pages.update');
        Route::delete('/{id}/delete', [PageController::class, 'destroy'])->name('admin.pages.destroy');
    });

    Route::get('/send-emails', [SendEmailController::class, 'index'])->name('admin.send-emails.index');
    Route::post('/send-emails', [SendEmailController::class, 'store'])->name('admin.send-emails.store');

    Route::get('/top-users', [TopUserController::class, 'index'])->name('admin.top-users.index');
    Route::get('/top-links', [STUController::class, 'popular'])->name('admin.popular.stu');

    Route::prefix('widgets')->group( function () {
        Route::get('/', [WidgetController::class, 'index'])->name('admin.widgets.index');
        Route::get('/create', [WidgetController::class, 'create'])->name('admin.widgets.create');
        Route::post('/store', [WidgetController::class, 'store'])->name('admin.widgets.store');
        Route::get('/{id}/edit', [WidgetController::class, 'edit'])->name('admin.widgets.edit');
        Route::put('/{id}', [WidgetController::class, 'update'])->name('admin.widgets.update');
    });

    Route::prefix('layouts')->group( function () {
        Route::get('/', [LevelController::class, 'index'])->name('admin.layouts.index');
        Route::get('/create', [LevelController::class, 'create'])->name('admin.layouts.create');
        Route::post('/store', [LevelController::class, 'store'])->name('admin.layouts.store');
        Route::get('/{id}/edit', [LevelController::class, 'edit'])->name('admin.layouts.edit');
        Route::put('/{id}', [LevelController::class, 'update'])->name('admin.layouts.update');
    });

    Route::prefix('menus')->group( function () {
        Route::get('/', [MenuController::class, 'index'])->name('admin.menus.index');
        Route::get('/create', [MenuController::class, 'create'])->name('admin.menus.create');
        Route::post('/store', [MenuController::class, 'store'])->name('admin.menus.store');
        Route::get('/{id}/edit', [MenuController::class, 'edit'])->name('admin.menus.edit');
        Route::put('/{id}', [MenuController::class, 'update'])->name('admin.menus.update');
        Route::delete('/{id}/delete', [MenuController::class, 'destroy'])->name('admin.menus.destroy');
    });
});