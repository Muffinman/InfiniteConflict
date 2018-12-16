<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PingController extends Controller
{
    public function ping() {
        return response()->json('pong');
    }
}
