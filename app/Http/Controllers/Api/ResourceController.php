<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ResourceResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Resource;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return ResourceResource::collection(Resource::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request)
    {
        $resource = new Resource;
        $resource->fill($request->all());
        return new ResourceResource($resource);
    }

    /**
     * Display the specified resource.
     *
     * @param  Resource $resource
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Resource $resource)
    {
        return new ResourceResource($resource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resource $resource
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, Resource $resource)
    {
        $resource->fill($request->all());
        return new ResourceResource($resource);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Resource $resource
     * @return \Illuminate\Support\Facades\Response
     * @throws \Exception;
     */
    public function destroy(Resource $resource)
    {
        $resource->delete();
        return response()->json('OK', 204);
    }
}
