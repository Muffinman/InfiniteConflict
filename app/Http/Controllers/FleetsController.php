<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FleetsController extends Controller
{
    public function index(Request $request)
    {

        return view('fleets/index', [
            'fleets' => Auth::user()->fleets,
        ]);
    }
}
