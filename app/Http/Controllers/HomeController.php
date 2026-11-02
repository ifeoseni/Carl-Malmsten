<?php

namespace App\Http\Controllers;

use App\Models\ServiceCard;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'services' => ServiceCard::where('is_active', true)->orderBy('order')->orderBy('id')->get(),
        ]);
    }
}
