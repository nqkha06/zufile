<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\NOTELevelRepositoryInterface as LevelRepository;
use Illuminate\Support\Facades\Cache;

class NOTELevelComposer
{
    protected $levelRepository;

    public function __construct (
        LevelRepository $levelRepository,
    ) {
        $this->levelRepository = $levelRepository;
    }

    public function compose(View $view)
    {
        $levels = Cache::remember('note_active_levels', 60 * 60, function() {
            return $this->levelRepository->findMany([['status', '=', 1]]);
        });
        
        $view->with('note_levels', $levels);
    }
}
