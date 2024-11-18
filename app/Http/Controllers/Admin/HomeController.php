<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\AccessRepositoryInterface as AccessRepository;
class HomeController extends Controller
{
    protected $accessRepository;

    public function __construct(AccessRepository $accessRepository) {
        $this->accessRepository = $accessRepository;
    }

    public function index()
    {
        $real_time_30m = $this->accessRepository->getRealTimeAccesseMinutes();
        $chartData = $real_time_30m;
        return view('backend.admin.real_time.index', compact('chartData'));
    }
}
