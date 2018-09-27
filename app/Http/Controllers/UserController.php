<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param Post $post
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()
            ->view('blog.users.show', [
                'user' => $user->load('posts', 'comments')
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return response()
            ->view('blog.users.edit', [
                'user' => $user
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UserRequest $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());
        return response()->redirectToRoute('users.show', ['id' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

//    public function follow(User $user, Request $request)
//    {
//        $is_liked = $request->is_liked == "true" ? true : false;
//        $comment->likes()->firstOrCreate([
//            'user_id' => \auth()->user()->id
//        ])->update([
//            'is_liked' => $is_liked,
//        ]);
//        return response()->json($is_liked);
//    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFollowers(User $user)
    {
        return response()->json([
            'count' => $user->followed()->count()
        ]);
    }
}
