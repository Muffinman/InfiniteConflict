<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ResearchController extends Controller
{
    public function index(Request $request)
    {

        return view('research/index', [

        ]);
    }
}
