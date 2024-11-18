<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\LevelRepositoryInterface as LevelRepository;
use Illuminate\Support\Facades\Cache;

class STULevelComposer
{
    protected $levelRepository;

    public function __construct (
        LevelRepository $levelRepository,
    ) {
        $this->levelRepository = $levelRepository;
    }

    public function compose(View $view)
    {
        $levels = Cache::remember('active_levels', 60 * 60, function() {
            return $this->levelRepository->getByCondition([['status', '=', 1]]);
        });
        
        $view->with('levels', $levels);
    }
}
