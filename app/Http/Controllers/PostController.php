<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'like', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()
            ->view('blog.posts.index', [
                'posts' => Post::with('user')->paginate(3)
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()
            ->view('blog.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        /** @var Post $post */
        $post = Auth::user()->posts()->create($request->validated());
        $this->uploadImage($request, $post);
        return response()->redirectToRoute('posts.show', ['id' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->view('blog.posts.show', [
            'post' => $post->load('comments.user', 'comments.likes')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return response()
            ->view('blog.posts.edit', [
                'post' => $post
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->validated());
        $this->uploadImage($request, $post);
        return response()->redirectToRoute('posts.show', ['id' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $this->deleteImage($post);
        $post->delete();
        return response()->redirectToRoute('posts.index');
    }

    /**
     * @param PostRequest $request
     * @param Post $post
     */
    public function uploadImage(PostRequest $request, Post $post)
    {
        if ($request->hasFile('image')) {
            $this->deleteImage($post);
            $post->image = $request->file('image')->store('public/image');
            $post->save();
        }
    }

    /**
     * @param Post $post
     */
    protected function deleteImage(Post $post)
    {
        if (Storage::exists($post->image)) {
            Storage::delete($post->image);
        }
    }

    /**
     * @param Post $post
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function like(Post $post, Request $request)
    {
        $is_liked = $request->is_liked == "true" ? true : false;
        $post->likes()->firstOrCreate([
            'user_id' => \auth()->user()->id
        ])->update([
            'is_liked' => $is_liked,
        ]);
        return response()->json($is_liked);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLikes(Post $post)
    {
        return response()->json([
            'count' => $post->likes()->where('is_liked', true)->count()
        ]);
    }
}
