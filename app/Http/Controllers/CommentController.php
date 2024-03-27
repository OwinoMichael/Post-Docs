<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::query()->get();

        return new JsonResponse([
            'data' => $comments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comments = Comment::query()->create([
            'comment' => $request->comment,
        ]);

        return new JsonResponse([
            'data' => $comments,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return new JsonResponse([
            'data' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $updated = $comment->update([
            'body' => $request->$comment ?? $comment->body,
        ],);

        if(!$updated){
            return new JsonResponse([
                'errors' => [
                    'Failed to update model.'
                ]
                ], 400);
        }

        return new JsonResponse([
            'data' => $comment
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
        $deleted = $comment->delete([
            'data' => $comment->forceDelete(),
        ]);

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
