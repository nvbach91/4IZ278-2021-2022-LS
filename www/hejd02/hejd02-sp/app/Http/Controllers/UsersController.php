<?php

namespace App\Http\Controllers;

use App\Custom\Features;
use App\Custom\Texts;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }
    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user): UserResource
    {
        Gate::authorize('manage-user', $user);
        return new UserResource($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return UserResource
     */
    public function store(UserRequest $request): UserResource
    {
        Features::emailCollection($request->input("email"));
        $user = User::create([
            'first_name' => $request->input("first_name"),
            'last_name' => $request->input("last_name"),
            'password' => Hash::make($request->input("password")),
            'email' => $request->input("email"),
            'role' => Texts::ROLE_USER,
            'phone' => $request->input("phone"),
        ]);

        $user->address()->create([
            'user_id' => $user->user_id,
            'region' => $request->input("region"),
            'town' => $request->input("town"),
            'street' => $request->input("street"),
            'street_number' => $request->input("street_number"),
            'zip' => $request->input("zip"),
        ]);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     */
    public function update(User $user)
    {
        Gate::authorize('manage-user', $user);
        Gate::authorize('manage-user-role', $user);
        Features::emailCollection(request()->input("email"));

        $newUserData = request()->all();
        $newUserData["password"] = Hash::make($newUserData["password"]);

        $user->update($newUserData);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user): Response
    {
        Gate::authorize('manage-user', $user);

        try {
            $user->delete();
        } catch (QueryException $e) {
            return response($e->errorInfo, 409);
        }

        return response(null, 204);
    }
}
