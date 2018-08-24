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
                        <form method="post" action="{{ route('comments.store') }}">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
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
                                <button type="submit" class="btn btn-light btn-sm"> Добавить комментарий
                                </button>
                            </div>
                        </form>
                        <hr class="my-4">
                    @endif

                    <section class="comment-list">

                        @foreach($post->comments->sortByDesc('id') as $comment)
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2 text-center">
                                            <img src="{{ $comment->user->avatar }}"
                                                 class="avatar"/>
                                            <p class="text-secondary text-center">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </p>

                                        </div>
                                        <div class="col-md-10">
                                            <p>
                                                <a class="float-left"
                                                   href="https://maniruzzaman-akash.blogspot.com/p/contact.html">
                                                    <strong>
                                                        {{ $comment->user->name }}
                                                    </strong>
                                                </a>
                                            </p>
                                            <div class="clearfix"></div>
                                            <p class="comment_{{ $comment->id }}">
                                                {{ $comment->text }}
                                            </p>
                                            <textarea style="display: none" id="comment_{{ $comment->id }}"
                                                      class="form-control">{{ $comment->text }}</textarea>
                                            <div align="right">
                                                <button type="submit"
                                                        class="btn btn-dark btn-sm save_comment"
                                                        data-comment_id="{{ $comment->id }}"
                                                        style="display: none"> Редактировать комментарий
                                                </button>
                                            </div>

                                            <!--
                                             <p>
                                                  <a class="float-right btn btn-outline-primary ml-2"> <i
                                                              class="fa fa-reply"></i> Reply</a>
                                              </p>
-->
                                        </div>
                                        @if(auth()->user() && auth()->user()->id == $comment->user_id)
                                            <form method="post"
                                                  action="{{ route('comments.destroy', ['id' => $comment->id]) }}">

                                                @csrf
                                                {{ method_field('DELETE') }}

                                                <button type="submit" style="position: absolute; top: 0; right: 5px">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if(auth()->user() && auth()->user()->id == $comment->user_id)
                                            <button class="edit_comment" data-comment_id="{{ $comment->id }}"
                                                    style="position: absolute; top: 0; right: 35px">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button>
                                        @endif
                                    </div>

                                    {{--<div class="card card-inner">--}}
                                    {{--<div class="card-body">--}}
                                    {{--<div class="row">--}}
                                    {{--<div class="col-md-2">--}}
                                    {{--<img src="https://image.ibb.co/jw55Ex/def_face.jpg"--}}
                                    {{--class="img img-rounded img-fluid"/>--}}
                                    {{--<p class="text-secondary text-center">--}}
                                    {{--{{ $comment->created_at }}--}}
                                    {{--</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-10">--}}
                                    {{--<p>--}}
                                    {{--<a href="https://maniruzzaman-akash.blogspot.com/p/contact.html">--}}
                                    {{--<strong>--}}
                                    {{--{{ $comment->user->name }}--}}
                                    {{--</strong>--}}
                                    {{--</a>--}}
                                    {{--</p>--}}
                                    {{--<p>--}}
                                    {{--{{ $comment->text }}--}}
                                    {{--</p>--}}
                                    {{--<p>--}}
                                    {{--<a class="float-right btn btn-outline-primary ml-2"> <i--}}
                                    {{--class="fa fa-reply"></i> Reply</a>--}}
                                    {{--</p>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        @endforeach
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection


