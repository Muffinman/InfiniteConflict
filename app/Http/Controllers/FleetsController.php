<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class FleetsController extends Controller
{
    public function index(Request $request)
    {
        return view('fleets/index', [
            'fleets' => Auth::user()->fleets,
        ]);
    }
}
