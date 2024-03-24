<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return new \Illuminate\Http\JsonResponse([
        'data' => 'aaa'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        return new \Illuminate\Http\JsonResponse([
            'data'=> 'posted'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return new \Illuminate\Http\JsonResponse([
            'data'=>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    public function update( User $user)
     {
        return new \Illuminate\Http\JsonResponse([
        'data'=> 'patched'
        ]);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return new \Illuminate\Http\JsonResponse([
            'data'=> 'deleted'
        ]);
    }
}
