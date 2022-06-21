<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreUserRequest;
use App\Http\Requests\v1\UpdateUserRequest;
use App\Http\Resources\v1\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        $users = User::all();

        if ($request->filled('include')) {
            //Check Errors on includes
            $errors = $this->checkRequestRelationshipErrors($request, User::$relationships);
            if (!empty($errors['errors'])) {
                return response()->json($errors, 422);
            }
            $this->setRequestRelationships($request, $users, User::$relationships);
        }

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return UserResource
     */
    public function store(StoreUserRequest $request): UserResource
    {
        $user = User::create($request->validated());

        return UserResource::make($user);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param User $user
     * @return UserResource|JsonResponse
     */
    public function show(Request $request, User $user): JsonResponse|UserResource
    {
        if ($request->filled('include')) {

            //Check Errors on includes
            $errors = $this->checkRequestRelationshipErrors($request, User::$relationships);
            if (!empty($errors['errors'])) {
                return response()->json($errors, 422);
            }
            $this->setRequestRelationships($request, $user, User::$relationships);
        }

        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return UserResource
     */
    public function update(UpdateUserRequest $request, User $user): UserResource
    {
        $user->update($request->validated());

        return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully',
        ]);
    }
}
