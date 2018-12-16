<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class ResearchController extends ApiController
{
    public function index(Request $request)
    {
        return view('research/index', [

        ]);
    }
}
