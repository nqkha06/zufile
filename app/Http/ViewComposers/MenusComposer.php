<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
use App\Models\MenuGroup;
use Illuminate\Support\Facades\Cache;

class MenusComposer
{
    protected $menus;

    // public function __construct()
    // {
    //     // Lấy tất cả menu groups cùng với menu items
    //     $this->menus = MenuGroup::with(['items' => function($query) {
    //         $query->whereNull('parent_id')->orderBy('order');
    //     }, 'items.children'])->get();
    // }
    public function __construct()
    {
        $this->menus = Cache::remember('menus', 60*60, function() {
            return MenuGroup::with(['items' => function($query) {
                $query->whereNull('parent_id')->orderBy('order');
            }, 'items.children'])->get();
        });
    }
    public function compose(View $view)
    {
        // Chia sẻ biến $menus với view
        $view->with('menus', $this->menus);
    }
}
