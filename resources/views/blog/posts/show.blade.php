@extends('layouts.app')

@section('css')
    <style>
        html, body {
            background: #66ffff url(/img/fon1.jpg);
            color: #990099;
            font-family: 'Parkavenue', cursive;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                            <button type="submit" class="btn btn-outline-dark btn-lg btn-block"> Добавить комментарий
                            </button>
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
                                            <p>
                                                {{ $comment->text }}
                                            </p>
                                            <p>
                                                <a class="float-right btn btn-outline-primary ml-2"> <i
                                                            class="fa fa-reply"></i> Reply</a>
                                            </p>
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
                                            <form method="post"
                                                  action="{{ route('comments.update', ['id' => $comment->id]) }}">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <button type="submit" style="position: absolute; top: 0; right: 35px">
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


