<?php

namespace App\Services;

use App\Repositories\Interfaces\PageRepositoryInterface as PageRepository;
use App\Services\Abstracts\CrudServiceAbstract;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PageService
 * @package App\Services
 */
class PageService extends CrudServiceAbstract
{
    
    protected function getRepositoryClass(): string {
        return PageRepository::class;
    }
    
    public function update($id, $req): ?Model
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
        return parent::update($id, $dataUpd);
    }
}
