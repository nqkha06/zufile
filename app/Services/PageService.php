<?php

namespace App\Services;

use App\Services\Interfaces\PageServiceInterface;
use App\Repositories\Interfaces\PageRepositoryInterface as PageRepository;

/**
 * Class PageService
 * @package App\Services
 */
class PageService implements PageServiceInterface
{
    protected $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }
    
    public function listAllPagesPaginated()
    {
        $search = [
            ['title', 'like', '%'.request()->keyword.'%']
        ];
        if (request()->created_at) {
            $search[] = ['created_at', 'date', request()->created_at];
        }

        return $this->pageRepository->getAllPaginated($search);
    }
    
    public function editPage($id)
    {
        return $this->pageRepository->find($id);
    }

    public function updatePage($id, $req)
    {
        // Handle the file upload
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $path = '/images/' . $imageName;
        }
        $dataUpd = [
            'title' => $req->title,
            'slug' => $req->slug,
            'summary' => $req->description,
            'content' => $req->content,
            'status' => $req->status,
        ];
        if (isset($path)) {
            $dataUpd['image'] = $path;
        }
        return $this->pageRepository->update($id, $dataUpd);
    }
}
