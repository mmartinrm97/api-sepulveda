<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreUserRequest;
use App\Http\Requests\v1\UpdateUserRequest;
use App\Http\Resources\v1\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

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
        $users = User::query();
        $orderColumn = $request->input('order_column', 'id');
        $orderDirection = $request->input('order_direction', 'asc');

        if ($request->filled('include')) {
            //Check Errors on includes
            $errors = $this->checkRequestRelationshipErrors($request, User::$relationships);
            if (!empty($errors['errors'])) {
                return response()->json($errors, 422);
            }
            $this->setRequestRelationships($request, $users, User::$relationships);
        }


        //Sort data
        if ($orderColumn != 'warehouses') {
//            dd('es diferente a wh');
            $users->orderBy($orderColumn, $orderDirection);
        } else {
//            dd('es wh');
//            $users->whereHas('warehouses', function($q) use($orderDirection) {
//                $q->orderBy('warehouses.description', $orderDirection);
//            });
            $users->withCount('warehouses')->orderBy('warehouses_count', $orderDirection);

        }

        $users->when($request->filled('search_global'), function ($query) use ($request) {
            $query->where(function($query) use($request){
                $query->where('id', 'LIKE', '%' . $request->input('search_global') . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $request->input('search_global') . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $request->input('search_global'));
            });
        })
            ->when($request->filled('search_is_active'), function ($query) use ($request) {
            $query->where('is_active', $request->input('search_is_active'));
        })
            ->when($request->filled('search_id'), function ($query) use ($request) {
                $query->where('id', 'LIKE', '%' . $request->input('search_id') . '%');
            })
            ->when($request->filled('search_first_name'), function ($query) use ($request) {
                $query->where('first_name', 'LIKE', '%' . $request->input('search_first_name') . '%');
            })
            ->when($request->filled('search_last_name'), function ($query) use ($request) {
                $query->where('last_name', 'LIKE', '%' . $request->input('search_last_name') . '%');
            });

        return UserResource::collection($users->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            if($request->input('password') === ''){
                dd('password vació');
            }
            $user = User::create($request->validated());
            DB::commit();
            return response()->json([
                'data' => [
                    'title' => 'User created successfully',
                    'product' => UserResource::make($user)
                ]
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'errors' => [
                    'title' => 'User creation failed',
                    'details' => $e->getMessage()
                ]
            ], 422);
        }
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
