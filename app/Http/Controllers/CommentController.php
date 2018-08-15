<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommRequest;
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
        $comment = Auth::user()->comments()->create($request->validated());
        return response()->redirectToRoute('posts.show', ['id' => $request->post_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment $comment
     * @return void
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommRequest $request, Comment $comment)
    {
        dd('d');
        $comment->update($request->validated());
        return response()->redirectToRoute('posts.show', ['id' => $comment->post_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->redirectToRoute('posts.show', ['id' => $comment->post_id]);
    }
}
