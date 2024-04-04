<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     * \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::query()->get();

        return UserResource::collection($users);

        // return new JsonResponse([
        //     'data' => $users
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return Resource
     * \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $users = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,

        ]);

        return new UserResource($users);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\User  $user
     * @return Resource
     *  \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return new UserResource($user);

        // return new JsonResponse([
        //     'data' => $user,
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\User  $user
     * @return Resource | JsonResponse
     */

    public function update(Request $request, User $user)
     {
        $updated = $user->update([
            'title' => $request->title ?? $user->title,
            'body' => $request->body ?? $user->body,
        ]);

        if(!$updated){
            return new JsonResponse([
                'errors' => [
                    'Failed to update model.'
                ]
                ], 400);
        }

        return new UserResource($user);

        // return new JsonResponse([
        //     'data' => $user,
        // ]);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return Resource | JsonResponse
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
       $deleted = $user->forceDeletedelete();

       if(!$deleted){
        return new JsonResponse([
            'error' => [
                'Could not delete'
            ]

            ], 400);
       }



       return new JsonResponse([
        'data'=>'Successfully Deleted',
       ]);
    }
}
