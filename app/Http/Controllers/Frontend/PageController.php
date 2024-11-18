<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PageRepositoryInterface as PageRepository;

class PageController extends Controller
{
    protected $pageRepository;

    public function __construct(PageRepository $pageRepository = null) {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $page_data = $this->pageRepository->firstByCondition([['slug', '=', $slug]]);

        if ($page_data) {
            return view('fontend.blog.page', compact('page_data'));
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
