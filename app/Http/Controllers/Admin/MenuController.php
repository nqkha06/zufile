<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuGroup;
use App\Models\MenuItem;

use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $menuGroups = MenuGroup::with('items')->get();
        return view('backend.admin.menu.index', compact('menuGroups'));
    }

    public function create()
    {
        return view('backend.admin.menu.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'group_name' => 'required|string|max:255',
            'group_slug' => 'required|string|max:255|unique:menu_groups,slug',
            'items' => 'array',
            'items.*.name' => 'required|string|max:255',
            'items.*.url' => 'required',
            'items.*.order' => 'integer',
            'items.*.children' => 'array|nullable', // cho các sub-items
            'items.*.children.*.name' => 'required_with:items.*.children|string|max:255',
            'items.*.children.*.url' => 'required_with:items.*.children',
            'items.*.children.*.order' => 'integer',
        ]);
        DB::beginTransaction();
        try{
            // Tạo menu group
            $group = MenuGroup::create([
                'name' => $request->group_name,
                'slug' => $request->group_slug
            ]);
        
            // Tạo các menu items
            $this->createMenuItems($group, $request->items);
            DB::commit();
            return redirect()->back()->with('success', 'Menu created successfully!');

            // return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }

        return redirect()->back()->with('success', 'Menu created successfully!');
    }
    
    protected function createMenuItems($group, $items)
    {
        foreach ($items as $item) {
            // Tạo mục chính
            $menuItemData = [
                'name' => $item['name'],
                'url' => $item['url'],
                'order' => $item['order'] ?? 0,
                'parent_id' => null, // Mặc định là null
            ];
    
            // Nếu mục này có parent, không cần menu_group_id
            if ($group instanceof MenuItem) {
                // Nếu group là một MenuItem, đây là sub-item
                $menuItemData['parent_id'] = $group->id; // Gán parent_id cho item con
            } else {
                // Nếu group là menu group, cần menu_group_id
                $menuItemData['menu_group_id'] = $group->id; // Gán menu_group_id cho item chính
            }
    
            // Tạo mục menu
            $menuItem = $group->items()->create($menuItemData);
    
            // Nếu có các mục con, gọi đệ quy
            if (isset($item['children']) && is_array($item['children'])) {
                $this->createMenuItems($menuItem, $item['children']); // Gọi đệ quy cho các mục con
            }
        }
    }
    
    public function edit($id)
    {
        $menuGroup = MenuGroup::with('items')->findOrFail($id);
        return view('backend.admin.menu.edit', compact('menuGroup'));
    }
    

    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu
        $request->validate([
            'group_name' => 'required|string|max:255',
            'group_slug' => 'required|string|max:255',
            'items.*.id' => 'integer',
            'items.*.name' => 'required|string|max:255',
            'items.*.url' => 'required',
            'items.*.order' => 'integer|min:0',
        ]);

        // Tìm MenuGroup theo ID
        $menuGroup = MenuGroup::findOrFail($id);
        
        // Cập nhật thông tin MenuGroup
        $menuGroup->name = $request->group_name;
        $menuGroup->slug = $request->group_slug;
        $menuGroup->save();
        $menuGroup->items()->delete();

        // Xử lý cập nhật MenuItems
        foreach ($request->items as $item) {
            // Tìm MenuItem theo ID
            $menuItem = MenuItem::create([
                'name' => $item['name'],
                'url' => $item['url'],
                'order' => $item['order'],
                'menu_group_id' => $menuGroup->id,
            ]);            

            if (isset($item['children'])) {
                // Xóa tất cả các sub-item c��
                $menuItem->children()->delete();

                // Thêm mới các sub-item mới
                foreach ($item['children'] as $child) {
                    $menuItem->children()->create([
                        'name' => $child['name'],
                        'url' => $child['url'],
                        'order' => $child['order'],
                        'parent_id' => $menuItem->id,
                    ]);
                }
            }
        }

        return redirect()->route('admin.menus.index')->with('success', 'Cập nhật menu thành công!');
    }
    

    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $menu = MenuGroup::with('items')->where('id', $id)->first();

            if ($menu->items->count()) {
                foreach ($menu->items as $item) {
                    $item->children()->delete();
                    $item->delete();
                }
            }
            $menu->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Menu đã được xoá thành công!');
        }catch(\Exception $e ){
            DB::rollBack();
            echo $e->getMessage();die();
        }
        return redirect()->route('admin.menus.index')->withErrors('Xoá Menu không thành công!');
    }
}

