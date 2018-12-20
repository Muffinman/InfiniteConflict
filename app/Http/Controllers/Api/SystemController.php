<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SystemResource;
use App\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return SystemResource::collection(System::paginate());
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
        $system = new System();
        $system->fill($request->all());

        return new SystemResource($system);
    }

    /**
     * Display the specified resource.
     *
     * @param System $system
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(System $system)
    {
        return new SystemResource($system);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param System                   $system
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, System $system)
    {
        $system->fill($request->all());

        return new SystemResource($system);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param System $system
     *
     * @throws \Exception;
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function destroy(System $system)
    {
        $system->delete();

        return response()->json('OK', 204);
    }
}
