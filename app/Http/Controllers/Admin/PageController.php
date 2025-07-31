<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PageService as PageService;
use App\Repositories\Interfaces\PageRepositoryInterface as PageRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Page\PageFilterRequest;
use App\Models\Language;
use App\Models\PageTranslation;

class PageController extends Controller
{
    protected $pageService;
    protected $pageRepository;
    protected $categoryRepository;

    public function __construct(PageService $pageService, PageRepository $pageRepository, CategoryRepository $categoryRepository)
    {
        $this->pageService = $pageService;
        $this->pageRepository = $pageRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(PageFilterRequest $request)
    {
        $filters = $request->validated();
        $pages = $this->pageService->getAllPaginated($filters);

        return view('backend.admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryRepository->all([]);

        return view('backend.admin.page.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required',
            'slug'  => 'required',
            'content'  => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Handle the file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $path = '/images/' . $imageName;
        }
        $dataUpd = [
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'summary' => $request->description,
            'image' => $path ?? null,
            'status' => $request->status
        ];

        $dataUpd = array_filter($dataUpd, function($value) {
            return !is_null($value);
        });

        $this->pageRepository->create($dataUpd);

        return redirect()->route('admin.pages.index')->with('success', 'Thêm mới tang thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $id)
    {
        $lang = Language::where(['code' => $request->query('ref_lang', 'en')])->first();

        $page = $this->pageService->findOrFail($id);
        return view('backend.admin.page.edit', compact('page', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $request->validate([
        //     // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // // Handle the file upload
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time().'.'.$image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $imageName);

        //     $path = '/images/' . $imageName;
        // }
        $dataUpd = [
            'status' => $request->status
        ];
        // if (isset($path)) {
        //     $dataUpd['image'] = $path;
        // }

        $this->pageRepository->update($id, $dataUpd);

        PageTranslation::updateOrCreate(
            [
                'page_id' => $id,
                'lang_code' => $request->lang,
            ],
            [
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
            ]
        );

        return redirect()->route('admin.pages.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try{
            $this->pageRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.pages.index')->with('success', 'Trang đã được xoá thành công!');
        }catch(\Exception $e ){
            DB::rollBack();
            echo $e->getMessage();die();
        }
        return redirect()->route('admin.pages.index')->withErrors('Xoá Trang không thành công!');
    }
}
