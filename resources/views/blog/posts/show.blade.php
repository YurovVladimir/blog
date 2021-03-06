@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/comment.js') }}" defer></script>
@endsection


@section('content')
    <div class="container" style="position: relative; top: 10vh">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">

                @if(auth()->user() && auth()->user()->id == $post->user_id)
                    <div align="left">
                        <form method="post" action="{{ route('posts.destroy',['id' => $post->id]) }}">

                            <a role="button" class="btn btn-simple btn-dark btn-sm text-dark"
                               href="{{ route('posts.edit',['id' => $post->id]) }}">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-simple btn-dark btn-sm text-dark">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </form>
                    </div>
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
                    <img src="{{ isset($post->image) ? asset(Storage::url($post->image)) : '/img/default_image.jpg'}}"
                         class="img-fluid media-middle">
                </div>

                <div class="form-inline">
                    <p class="lead">
                        <i class="fa fa-eye text-default"></i>
                        {{ $post->view_count }}
                    </p>
                    <div style="position: absolute; right: 20px">
                        <button class="btn btn-dark btn-simple btn-sm liked_post" data-post_id="{{ $post->id ?? 0 }}">
                            <i class="fa @if(auth()->user() && isset($post) && $post->likes->where('user_id', \auth()->user()->id)->where('is_liked', true)->count()) text-danger fa-thumbs-up fa-2x
                                    @else text-dark fa-thumbs-o-up fa-2x @endif  " aria-hidden="false"></i>
                            <span class="count_post">{{ isset($post) ? $post->likes->where('is_liked', true)->count() : '' }}</span>
                        </button>
                    </div>
                </div>

                <hr class="my-4">

                @if(auth()->user())
                    <input type="hidden" id="post_id" value="{{ $post->id }}" name="post_id">
                    @csrf
                    <div class="media media-post">
                        <a class="pull-left author" href="{{ route('users.show', ['id' => auth()->user()->id])}}">
                            <div class="avatar">
                                <img class="media-object img-raised avatar" alt="64x64"
                                     src="{{ isset(auth()->user()->avatar) ? Storage::url(auth()->user()->avatar) : '/img/default_avatar.jpg'}}"
                                     style="position: relative; right: 3vh">
                            </div>
                        </a>
                        <div class="media-body">
                                <textarea class="form-control {{ $errors->has('text') ? ' is-invalid' : '' }}"
                                          id="commentInput" name="text" placeholder="Оставьте комментарий"
                                          rows="4"></textarea>
                            @if ($errors->has('text'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('text') }}
                                </div>
                            @endif
                            <div class="media-footer" align="right">
                                <button class="btn btn-dark btn-simple btn-round store_comment" type="submit">
                                    <i class="now-ui-icons ui-1_send"></i> Reply
                                </button>
                            </div>
                            <div style="display:none;">
                                @include('blog.comments.comment_block')
                            </div>
                        </div>
                    </div>

                @endif

                <section class="comment-list">
                    @foreach($post->comments->sortByDesc('id') as $comment)
                            @include('blog.comments.comment_block')
                    @endforeach
                </section>
            </div>
        </div>
    </div>
@endsection


