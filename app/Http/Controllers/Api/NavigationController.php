<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class NavigationController extends ApiController
{
    public function index(Request $request)
    {
        return view('nav/index', [

        ]);
    }
}
