<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class AlliancesController extends ApiController
{
    public function index(Request $request)
    {
        return view('alliances/index', [

        ]);
    }
}
