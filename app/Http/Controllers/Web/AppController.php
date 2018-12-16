<?php

namespace App\Http\Controllers\Web;

class AppController extends WebController
{
    public function index()
    {
        return view('index');
    }
}
