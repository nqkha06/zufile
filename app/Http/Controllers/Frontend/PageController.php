<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PageRepositoryInterface as PageRepository;
use App\Models\PageTranslation;
class PageController extends Controller
{
    protected $pageRepository;

    public function __construct(PageRepository $pageRepository) {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $page_data = PageTranslation::where('slug', $slug)->where('lang_code', app()->getLocale())->first();
        // $page_data = $this->pageRepository->findFirst([['slug', '=', $slug]]);
        if ($page_data) {
            return view('frontend.blog.page', compact('page_data'));
        }

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
