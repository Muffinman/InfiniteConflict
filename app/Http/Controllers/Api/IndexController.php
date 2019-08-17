<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class IndexController extends ApiController
{
    public function index(Request $request)
    {
        return response()->json('ok');
    }
}
