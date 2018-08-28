@extends('layouts.app')
@section('js')
    <script src="{{ asset('js/comment.js') }}" defer></script>
@endsection

@section('css')
    <style>
        html, body {
            background: #122b40 url(/img/fon1.jpg);
            color: #000000;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="jumbotron">
                    @if(auth()->user() && auth()->user()->id == $post->user_id)
                        <form method="post" action="{{ route('posts.destroy',['id' => $post->id]) }}">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-dark">
                                Удалить пост
                            </button>
                        </form>
                    @endif
                    <input type="hidden" id="post_id" value="{{ $post->id }}">
                    <h1 class="display-3" align="center">
                        {{ ucfirst($post->name) }}
                    </h1>
                    <p class="lead">
                        {{ $post->description }}
                    </p>
                    <hr class="my-4 ">
                    <div class="text-center">
                        <img src="{{ preg_match('/^http/', $post->image) ? $post->image : asset(Storage::url($post->image)) }}"
                             class="img-fluid media-middle">
                    </div>
                    <hr class="my-4">
                    @if(auth()->user() && auth()->user()->id == $post->user_id)
                        <a role="button" class="btn btn-outline-dark btn-lg btn-block"
                           href="{{ route('posts.edit',['id' => $post->id]) }}"> Редактироваь пост
                        </a>
                        <hr class="my-4 ">
                    @endif

                    @if(auth()->user())
                            <input type="hidden" id="post_id" value="{{ $post->id }}" name="post_id">
                            @csrf
                            <textarea class="form-control {{ $errors->has('text') ? ' is-invalid' : '' }}"
                                      id="commentInput" name="text" rows="3">
                            </textarea>
                            @if ($errors->has('text'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('text') }}
                                </div>
                            @endif
                            <br>
                            <div align="right">
                                <button type="submit" class="btn btn-light btn-sm store_comment">
                                    Добавить комментарий
                                </button>
                                <!-- data-comment_id="{ $comment->id }}"-->
                            </div>

                            <div style="display:none;">
                                @include('blog.comments.comment_block')
                            </div>

                        <hr class="my-4">
                    @endif

                    <section class="comment-list">
                        @foreach($post->comments->sortByDesc('id') as $comment)

                            @include('blog.comments.comment_block')
                        @endforeach
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection


