<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Enums\BaseStatusEnum;

class BaseStatusComposer
{
    public function compose(View $view)
    {
        $view->with('baseStatus', BaseStatusEnum::cases());
    }
}
