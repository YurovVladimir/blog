<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommRequest $request)
    {
//      return redirect()->back();
        return response()->json(Auth::user()->comments()->create($request->validated())->load('user'), 201);
    }

    /**я
     * Display the specified resource.
     *
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment $comment
     * @return void
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommRequest $request
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommRequest $request, Comment $comment)
    {
        return response()->json($comment->update($request->validated()), 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        /**       $comment->delete();
         * return response()->redirectToRoute('posts.show', ['id' => $comment->post_id]);
         **/
        return response()->json(($comment->delete()), 204);
    }

    /**
     * @param Comment $comment
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function like(Comment $comment, Request $request)
    {
        $is_liked = $request->is_liked == "true" ? true : false;
        $comment->likes()->firstOrCreate([
            'user_id' => \auth()->user()->id
        ])->update([
            'is_liked' => $is_liked,
        ]);
        return response()->json($is_liked);
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLikes(Comment $comment)
    {
        return response()->json([
            'count' => $comment->likes()->where('is_liked', true)->count()
        ]);
    }
}
