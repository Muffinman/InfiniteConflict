<?php

namespace App\Http\Controllers\Api;

use App\Alliance;
use App\Http\Resources\AllianceResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllianceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return AllianceResource::collection(Alliance::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request)
    {
        $alliance = new Alliance;
        $alliance->fill($request->all());
        return new AllianceResource($alliance);
    }

    /**
     * Display the specified resource.
     *
     * @param  Alliance $alliance
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Alliance $alliance)
    {
        return new AllianceResource($alliance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Alliance $alliance
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, Alliance $alliance)
    {
        $alliance->fill($request->all());
        return new AllianceResource($alliance);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Alliance $alliance
     * @return \Illuminate\Support\Facades\Response
     * @throws \Exception;
     */
    public function destroy(Alliance $alliance)
    {
        $alliance->delete();
        return response()->json('OK', 204);
    }
}
