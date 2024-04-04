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

class PostController extends Controller
{
    use HasFactory;




    /**
     * Display a listing of the resource.
     *
     *  @return ResourceCollection
     *  \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = Post::query()->get();

        return PostResource::collection($users);

        // return new JsonResponse([
        //     'data' => $posts
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return PostResource
     * \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $created = DB::transaction(function () use ($request){

            $created = Post::query()->create([
                'title' => $request->title,
                'body' => $request->body,
            ]);

            $created->users()->sync($request->user_id);

            return $created;
        });

        return new PostResource($created);

        // return new JsonResponse([
        //     'data' => $created
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return PostResource
     *  \Illuminate\Http\JsonResponse
     */
    public function show(Post $post)
    {
        // return new JsonResponse([
        //     'data' => $post,
        // ]);

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Post  $post
     * @return PostResource | JsonResponse
     *  \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Post $post)
    {

      //Explicit Array // $post->update($request->only(['title', 'body']));
        $updated = $post->update([
            'title' => $request->title ?? $post->title,
            'body' => $request->body ?? $post->body,
        ]);

        if(!$updated){
            return new JsonResponse([
                'errors' => [
                    'Failed to update model.'
                ]
                ], 400);
        }

        //return new PostResource($post);

        return new JsonResponse([
            'data' => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return PostResource | JsonResponse
     *  \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        $deleted = $post->forceDelete();

        if(!$deleted){
            return new JsonResponse([
                'errors' => [
                    'Could not delete resource'
                ]
                ], 400);
        }

        //return new PostResource($deleted);

        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}
