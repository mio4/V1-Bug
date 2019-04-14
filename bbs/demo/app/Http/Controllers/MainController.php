<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function mainPage()
    {
        $binding = [
            'title' => '注册'
        ];
        return view('main-page', $binding);
    }
}