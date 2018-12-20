<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResearchResource;
use App\Research;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return ResearchResource::collection(Research::paginate());
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
        $research = new Research();
        $research->fill($request->all());

        return new ResearchResource($research);
    }

    /**
     * Display the specified resource.
     *
     * @param Research $research
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Research $research)
    {
        return new ResearchResource($research);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Research                 $research
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, Research $research)
    {
        $research->fill($request->all());

        return new ResearchResource($research);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Research $research
     *
     * @throws \Exception;
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function destroy(Research $research)
    {
        $research->delete();

        return response()->json('OK', 204);
    }
}
