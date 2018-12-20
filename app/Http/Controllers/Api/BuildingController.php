<?php

namespace App\Http\Controllers\Api;

use App\Building;
use App\Http\Resources\BuildingResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return BuildingResource::collection(Building::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request)
    {
        $building = new Building;
        $building->fill($request->all());
        return new BuildingResource($building);
    }

    /**
     * Display the specified resource.
     *
     * @param  Building $building
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Building $building)
    {
        return new BuildingResource($building);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Building $building
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, Building $building)
    {
        $building->fill($request->all());
        return new BuildingResource($building);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Building $building
     * @return \Illuminate\Support\Facades\Response
     * @throws \Exception;
     */
    public function destroy(Building $building)
    {
        $building->delete();
        return response()->json('OK', 204);
    }
}
