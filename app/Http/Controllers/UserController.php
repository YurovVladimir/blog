<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()
            ->view('blog.users.show', [
                'user' => $user->load([
                    'posts',
                    'comments',
                    'followers' => function($query) {
                        $query->distinct('id');
                    }
                ])
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
        $this->uploadImage($request, $user);
        return response()->redirectToRoute('users.show', ['id' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow(User $user)
    {
        $user->followers()->attach(auth()->user()->id);
        return response()->json(null, 201);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function unFollow(User $user)
    {
        $user->followers()->detach(auth()->user()->id);
        return response()->json(null, 204);
    }
    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFollowers(User $user)
    {
        return response()->json([
            'count' => $user->followers
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     */
    public function uploadImage(Request $request, User $user)
    {
        if ($request->hasFile('avatar')) {
            $this->deleteImage($user);
            $user->avatar = $request->file('avatar')->store('public/avatar');
            $user->save();
        }
    }

    /**
     * @param User $user
     */
    protected function deleteImage(User $user)
    {
        if (Storage::exists($user->avatar)) {
            Storage::delete($user->avatar);
        }
    }
}
