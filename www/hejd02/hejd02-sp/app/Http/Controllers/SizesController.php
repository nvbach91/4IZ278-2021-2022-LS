<?php

namespace App\Http\Controllers;

use App\Http\Requests\SizeRequest;
use App\Http\Resources\SizesResource;
use App\Models\Size;
use Illuminate\Database\QueryException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use JetBrains\PhpStorm\Pure;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return SizesResource::collection(Size::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  SizeRequest  $request
     * @return SizesResource
     */
    public function store(SizeRequest $request): SizesResource
    {
        $size = Size::create([
            'size_type' => $request->input('size_type'),
        ]);

        return new SizesResource($size);
    }

    /**
     * Display the specified resource.
     *
     * @param Size $size
     * @return SizesResource
     */
    #[Pure] public function show(Size $size): SizesResource
    {
        return new SizesResource($size);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param SizeRequest $request
     * @param Size $size
     * @return SizesResource
     */
    public function update(SizeRequest $request, Size $size): SizesResource
    {
        $size->update([
            'size_type' => $request->input('size_type')
        ]);

        return new SizesResource($size);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Size $size
     * @return Response
     */
    public function destroy(Size $size): Response
    {
        try {
            $size->delete();
        } catch (QueryException $e) {
            return response($e->errorInfo, 409);
        }
        return response(null, 204);
    }
}
