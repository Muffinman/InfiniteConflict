<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;

class FleetsController extends ApiController
{
    public function index(Request $request)
    {
        return view('fleets/index', [
            'fleets' => Auth::user()->fleets,
        ]);
    }
}
