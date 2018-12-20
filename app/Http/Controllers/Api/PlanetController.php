<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PlanetResource;
use App\Planet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return PlanetResource::collection(Planet::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request)
    {
        $planet = new Planet;
        $planet->fill($request->all());
        return new PlanetResource($planet);
    }

    /**
     * Display the specified resource.
     *
     * @param  Planet $planet
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Planet $planet)
    {
        return new PlanetResource($planet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Planet $planet
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, Planet $planet)
    {
        $planet->fill($request->all());
        return new PlanetResource($planet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Planet $planet
     * @return \Illuminate\Support\Facades\Response
     * @throws \Exception;
     */
    public function destroy(Planet $planet)
    {
        $planet->delete();
        return response()->json('OK', 204);
    }
}
