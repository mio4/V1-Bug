<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function mainPage()
    {
        $binding = [
            'title' => '主页面'
        ];
        return view('main-page', $binding);
    }
}