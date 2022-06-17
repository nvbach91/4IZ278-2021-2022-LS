<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Database\QueryException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        if (Gate::allows('your-address', Address::all())) {
            return AddressResource::collection(Address::where("user_id", "=", auth()->user()->user_id)->get());
        }

        return AddressResource::collection(Address::all());
    }

    public function show(Address $address): AddressResource
    {
        Gate::authorize('manage-address', $address);

        return new AddressResource($address);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AddressRequest  $request
     * @return AddressResource
     */
    public function store(AddressRequest $request): AddressResource
    {
        Gate::authorize('create-address', $request);

        $address = Address::create([
            'user_id' => $request->input("user_id"),
            'region' => $request->input("region"),
            'town' => $request->input("town"),
            'street' => $request->input("street"),
            'street_number' => $request->input("street_number"),
            'zip' => $request->input("zip")
        ]);

        return new AddressResource($address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Address $address
     * @return AddressResource
     */
    public function update(Address $address): AddressResource
    {
        Gate::authorize('manage-address', $address);

        $address->update(request()->all());
        return new AddressResource($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $address
     * @return Response
     */
    public function destroy(Address $address): Response
    {
        Gate::authorize('manage-address', $address);

        try {
            $address->delete();
        } catch (QueryException $e) {
            return response($e->errorInfo, 409);
        }

        return response(null, 204);
    }
}
