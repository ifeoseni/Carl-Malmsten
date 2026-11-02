<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\ServiceCard;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'tabs' => config('cms.tabs'),
            'serviceCount' => ServiceCard::count(),
            'menuCount' => MenuItem::count(),
        ]);
    }
}
