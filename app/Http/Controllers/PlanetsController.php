<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ruler;
use App\Planet;
use App\PlanetStartingBuilding;
use Auth;

class PlanetsController extends Controller
{

    public function index(Request $request)
    {

        return view('planets/index', [
            'planets' => Auth::user()->planets,
        ]);
    }


    public function view(Request $request, $id)
    {

        $planet = Planet::find($id);

        if (!$planet) {
            return redirect()->route('planets.index')->withErrors(['This planet does not exist.']);            
        }

        if ($planet->ruler_id !== Auth::user()->id) {
            return redirect()->route('planets.index')->withErrors(['This planet does not belong to you!']);
        }


        return view('planets/view', [
            'planet' => $planet,
        ]);
    }

}
