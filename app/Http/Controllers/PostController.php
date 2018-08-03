<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('user')->all();
        return response()
            ->view('blog.posts', [
                'posts' => $posts
            ]);
    }
    //
}
