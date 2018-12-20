<?php

namespace App\Http\Controllers\Api;

use App\Fleet;
use App\Http\Controllers\Controller;
use App\Http\Resources\FleetResource;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return FleetResource::collection(Fleet::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request)
    {
        $fleet = new Fleet();
        $fleet->fill($request->all());

        return new FleetResource($fleet);
    }

    /**
     * Display the specified resource.
     *
     * @param Fleet $fleet
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Fleet $fleet)
    {
        return new FleetResource($fleet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Fleet                    $fleet
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, Fleet $fleet)
    {
        $fleet->fill($request->all());

        return new FleetResource($fleet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Fleet $fleet
     *
     * @throws \Exception;
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function destroy(Fleet $fleet)
    {
        $fleet->delete();

        return response()->json('OK', 204);
    }
}
