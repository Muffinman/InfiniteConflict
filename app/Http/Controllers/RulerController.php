<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Planet;

use Validator;
use Auth;

class RulerController extends Controller
{
    public function createEmpire(Request $request) {

        return view('rulers/create', [
            'data' => [
                'ruler_name' => $request->input('ruler_name'),
                'home_planet_name' => $request->input('home_planet_name'),
            ],
        ]);

    }

    public function storeEmpire(Request $request) {
        $validator = Validator::make($request->all(), [
            'ruler_name' => 'required|unique:rulers,name,' . Auth::user()->id . '|max:32',
            'home_planet_name' => 'required|max:32',
        ]);

        if ($validator->fails()) {
            return redirect()->route('ruler.create')->withInput()->withErrors($validator);
        }

        $home_planet = Planet::homePlanets()->unpopulated()->first();
        if (!$home_planet) {
            return redirect()->route('ruler.create')->withInput()->withErrors(['home_planet_name' => 'Sorry, there are no home planets left!']);
        }

        $home_planet->name = $request->input('home_planet_name');
        $home_planet->ruler_id = Auth::user()->id;
        $home_planet->save();

        $user = Auth::user();
        $user->name = $request->input('ruler_name');
        $user->save();

        return redirect()->route('planets.index');

    }

}
