<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Socialite;

class WelcomeController extends Controller
{
    public function index(Request $request) {
        return view('welcome');
    }
}
