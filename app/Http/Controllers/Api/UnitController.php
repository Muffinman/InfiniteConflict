<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UnitResource;
use App\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return UnitResource::collection(Unit::paginate());
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
        $unit = new Unit();
        $unit->fill($request->all());

        return new UnitResource($unit);
    }

    /**
     * Display the specified resource.
     *
     * @param Unit $unit
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Unit $unit)
    {
        return new UnitResource($unit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Unit                     $unit
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, Unit $unit)
    {
        $unit->fill($request->all());

        return new UnitResource($unit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Unit $unit
     *
     * @throws \Exception;
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();

        return response()->json('OK', 204);
    }
}
