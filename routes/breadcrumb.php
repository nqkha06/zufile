<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Admin
Breadcrumbs::for('admin.index', function (BreadcrumbTrail $trail) {
    $trail->push('Admin', route('admin.index'));
});

// Blog
Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
    $trail->push('Blog', route('blog'));
});
// Blog > [post]
Breadcrumbs::for('blog.article', function (BreadcrumbTrail $trail, $article) {
    $trail->parent('blog');
    $trail->push(__('Bài đăng'), route('blog.article', $article));
});

$breadcrumbs = [
    'admin.fingerprints.index' => __('ingerprints.index'),
    'admin.dashboard.index' => __('Dashboard'),
    'admin.top-users.index' => __('Top Users'),

    'admin.access.index' => __('Access'),
    'admin.stats.level' => __('Level'),
    'admin.invoices.index' => __('Invoices'),
    'admin.users.index' => __('Users'),
    'admin.roles.index' => __('Roles'),
    'admin.permissions.index' => __('Permissions'),
    'admin.permission-groups.index' => __('Permission groups'),
    'admin.stu.index' => 'STU',
    'admin.note.index' => __('NOTE'),
    'admin.general.index' => __('General'),
    'admin.levels.index' => __('Levels'),
    'admin.note_levels.index' => __('Quản lý cấp độ Note'),
    'admin.payment-methods.index' => __('Payment Methods'),
    'admin.categories.index' => __('Blog - Danh mục'),
    'admin.tags.index' => __('Thẻ'),
    'admin.posts.index' => __('Blog - Posts'),
    'admin.pages.index' => __('Blog - Pages'),
    'admin.widgets.index' => __('Widgets'),
    'admin.menus.index' => __('Menus'),
    'admin.send-emails.index' => __('Send Mails'),
    'admin.popular.stu' => __('STU Phổ biến'),

    'admin.system.index' => __('System'),
    'admin.system.email' => __('System'),

    'file_editor.index' => __('Quản lý mã nguồn')

];

// Tạo các breadcrumb cơ bản
foreach ($breadcrumbs as $route => $title) {
    Breadcrumbs::for($route, function (BreadcrumbTrail $trail) use ($route, $title) {
        $trail->parent('admin.index');
        $trail->push($title, route($route));
    });
}

Breadcrumbs::for('admin.fingerprints.show', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.fingerprints.index');
});


// Admin > Users > [user]
Breadcrumbs::for('admin.users.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push($user->name, route('admin.users.show', $user->id));
});

// Admin > Users > create
Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.users.index');
    $trail->push(__('Create user'), route('admin.users.create'));
});

// Admin > Users > [user] > edit
Breadcrumbs::for('admin.users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('Edit User: '.$user->name, route('admin.users.edit', $user->id));
});

// Admin > Users > [user] > edit
Breadcrumbs::for('admin.users.check', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('Check User: '.$user->name, route('admin.users.check', $user->id));
});
// Admin > Roles > create
Breadcrumbs::for('admin.roles.add', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('admin.roles.index');
    $trail->push(__('Add permission'), route('admin.roles.add', $role->id));
});

// Admin > Permissions > [permission] > edit
Breadcrumbs::for('admin.permissions.edit', function (BreadcrumbTrail $trail, $permission) {
    $trail->parent('admin.permissions.index');
    $trail->push($permission->name, route('admin.permissions.edit', $permission->id));
});

Breadcrumbs::for('admin.permission-groups.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.permission-groups.index');
    $trail->push(__('Create Permission group'), route('admin.permission-groups.create'));
});

Breadcrumbs::for('admin.permission-groups.edit', function (BreadcrumbTrail $trail, $permission_group) {
    $trail->parent('admin.permission-groups.index');
    $trail->push($permission_group->name, route('admin.permission-groups.edit', $permission_group->id));
});

// Admin > Levels > [level] > edit
Breadcrumbs::for('admin.levels.edit', function (BreadcrumbTrail $trail, $level) {
    $trail->parent('admin.levels.index');
    $trail->push('Edit: '.$level->name, route('admin.levels.edit', $level->id));
});

// Admin > Levels > [level] > config
Breadcrumbs::for('admin.levels.editConfig', function (BreadcrumbTrail $trail, $level) {
    $trail->parent('admin.levels.index');
    $trail->push('Config: '.$level->name, route('admin.levels.editConfig', $level->id));
});

// Admin > Levels > [level] > pageload
Breadcrumbs::for('admin.levels.editPageload', function (BreadcrumbTrail $trail, $level) {
    $trail->parent('admin.levels.index');
    $trail->push('Pageload: '.$level->name, route('admin.levels.editPageload', $level->id));
});

// Admin > Note level > [page] > edit
Breadcrumbs::for('admin.pages.edit', function (BreadcrumbTrail $trail, $page) {
    $trail->parent('admin.pages.index');
    $trail->push('Edit page: '.$page->title, route('admin.pages.edit', $page->id));
});

// Admin > NOTE Levels > create
Breadcrumbs::for('admin.note_levels.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.note_levels.index');
    $trail->push('Thêm cấp độ', route('admin.levels.create'));
});

// Admin > Posts > create
Breadcrumbs::for('admin.posts.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.posts.index');
    $trail->push('Create post', route('admin.posts.create'));
});

// Admin > Posts > [post] > edit
Breadcrumbs::for('admin.posts.edit', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('admin.posts.index');
    $trail->push('Edit post: '.$post->title, route('admin.posts.edit', $post->id));
});

// Admin > Pages > create
Breadcrumbs::for('admin.pages.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pages.index');
    $trail->push('Create page', route('admin.pages.create'));
});

// Admin > Pages > [page] > edit
Breadcrumbs::for('admin.note_levels.edit', function (BreadcrumbTrail $trail, $level) {
    $trail->parent('admin.note_levels.index');
    $trail->push('Chỉnh sửa cấp độ: '.$level->name, route('admin.note_levels.edit', $level->id));
});

// Admin > Categories > [category] > edit
Breadcrumbs::for('admin.categories.edit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('admin.categories.index');
    $trail->push('Edit category: '.$category->name, route('admin.categories.edit', $category->id));
});

// Admin > Tags > create
Breadcrumbs::for('admin.tags.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.tags.index');
    $trail->push(__('Create tag'), route('admin.tags.create'));
});

// Admin > Invoices > [user] > edit
Breadcrumbs::for('admin.invoices.edit', function (BreadcrumbTrail $trail, $invoice) {
    $trail->parent('admin.invoices.index');
    $trail->push('Edit invoice: '.$invoice->id, route('admin.invoices.edit', $invoice->id));
});

// Admin > widgets > create
Breadcrumbs::for('admin.widgets.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.widgets.index');
    $trail->push(__('Create user'), route('admin.widgets.create'));
});

// Admin > menus > create
Breadcrumbs::for('admin.menus.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.menus.index');
    $trail->push(__('Create menu'), route('admin.menus.create'));
});

// Admin > Menus > [user] > edit
Breadcrumbs::for('admin.menus.edit', function (BreadcrumbTrail $trail, $menu) {
    $trail->parent('admin.menus.index');
    $trail->push('Edit menu: '.$menu->id, route('admin.menus.edit', $menu->id));
});


// Admin > Payment_methods > create
Breadcrumbs::for('admin.payment-methods.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.payment-methods.index');
    $trail->push(__('Create payment-methods'), route('admin.payment-methods.create'));
});

// Admin > Menus > [payment method] > edit
Breadcrumbs::for('admin.payment-methods.edit', function (BreadcrumbTrail $trail, $method) {
    $trail->parent('admin.payment-methods.index');
    $trail->push('Edit method: '.$method->id, route('admin.payment-methods.edit', $method->id));
});
