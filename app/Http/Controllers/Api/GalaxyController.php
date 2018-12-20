<?php

namespace App\Http\Controllers\Api;

use App\Galaxy;
use App\Http\Resources\GalaxyResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalaxyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return GalaxyResource::collection(Galaxy::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request)
    {
        $galaxy = new Galaxy;
        $galaxy->fill($request->all());
        return new GalaxyResource($galaxy);
    }

    /**
     * Display the specified resource.
     *
     * @param  Galaxy $allia$galaxynce
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Galaxy $galaxy)
    {
        return new GalaxyResource($galaxy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Galaxy $galaxy
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, Galaxy $galaxy)
    {
        $galaxy->fill($request->all());
        return new GalaxyResource($galaxy);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Galaxy $galaxy
     * @return \Illuminate\Support\Facades\Response
     * @throws \Exception;
     */
    public function destroy(Galaxy $galaxy)
    {
        $galaxy->delete();
        return response()->json('OK', 204);
    }
}
