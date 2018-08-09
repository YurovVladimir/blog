@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="jumbotron">
                    <h1 class="display-3" align="center">
                        {{ ucfirst($post->name) }}
                    </h1>
                    <p class="lead">
                        {{ $post->description }}
                    </p>
                    <hr class="my-4">
                    <img src="{{ asset(Storage::url($post->image)) }}" class="rounded mx-auto d-block">

                    @if(auth()->user() && auth()->user()->id == $post->user_id)
                        <a role="button" class="btn btn-outline-dark btn-lg btn-block"
                                href="{{ route('posts.edit',['id' => $post->id]) }}"> Редактироваь пост
                        </a>
                    @endif
                    <section class="comment-list">
                        @foreach($post->comments as $comment)
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="https://image.ibb.co/jw55Ex/def_face.jpg"
                                                 class="img img-rounded img-fluid"/>
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


