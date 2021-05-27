<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RulerResource;
use App\Models\Ruler;
use Illuminate\Http\Request;

class RulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return RulerResource::collection(Ruler::paginate());
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
        $ruler = new Ruler();
        $ruler->fill($request->all());

        return new RulerResource($ruler);
    }

    /**
     * Display the specified resource.
     *
     * @param Ruler $ruler
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Ruler $ruler)
    {
        return new RulerResource($ruler);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Ruler                    $ruler
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, Ruler $ruler)
    {
        $ruler->fill($request->all());

        return new RulerResource($ruler);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ruler $ruler
     *
     * @throws \Exception;
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function destroy(Ruler $ruler)
    {
        $ruler->delete();

        return response()->json('OK', 204);
    }
}
