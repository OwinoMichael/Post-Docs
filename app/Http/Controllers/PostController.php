<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralJsonException;
use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\PostRepository;
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
    public function index(Request $request)
    {
        throw new GeneralJsonException('some error', 422);
        $pageSize = $request->page_size ?? 20;
        $users = Post::query()->paginate($pageSize);

        return PostResource::collection($users);

        // return new JsonResponse([
        //     'data' => $posts
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostStoreRequest  $request
     * @return PostResource
     */
    public function store(PostStoreRequest $request, PostRepository $repository)
    {
        $created = $repository->create($request->only([
            'title',
            'body',
            'user_ids'
        ]));

        return new PostResource($created);
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
    public function update(Request $request, Post $post, PostRepository $repository)
    {
        $post = $repository->update($post, $request->only([
           'title',
           'body',
           'user_ids',
        ]));

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return PostResource | JsonResponse
     *  \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post, PostRepository $repository)
    {
        $deleted = $post->forceDelete($post);

        //return new PostResource($deleted);

        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}
