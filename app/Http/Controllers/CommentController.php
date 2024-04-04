<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use HasFactory;

    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     * \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::query()->get();

        return CommentResource::collection($comments);

        // return new JsonResponse([
        //     'data' => $comments
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return CommentResource
     *  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $created = Comment::query()->create([
            'body' => $request->body,
        ]);

        $created->users()->sync($request->user_id);

        return new CommentResource($created);

        // return new JsonResponse([
        //     'data' => 'hey',
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return CommentResource
     *  \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return new CommentResource($comment);

        // return new JsonResponse([
        //     'data' => $comment
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return CommentResource | JsonResponse
     * \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        // $updated = $comment->update([
        //     'body' => $request->body ?? $comment->body,
        // ]);

        // if(!$updated){
        //     return new JsonResponse([
        //         'errors' => [
        //             'Failed to update model.'
        //         ]
        //         ], 400);
        // }

        // // return new CommentResource($updated);

        // return new JsonResponse([
        //     'data' => $comment
        // ]);

        return new JsonResponse([
            'data' => "hey"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $deleted = $comment->forceDelete();

        if(!$deleted){
            return new JsonResponse([
                'error' => [
                    'Did not delete'
                ]
                ], 400);
        }

        return new JsonResponse([
            'data' => $comment,
        ]);
    }
}
