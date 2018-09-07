@extends('layouts.app')

@section('content')
    <div class="container" style="position: relative; top: 7vh">
        <div class="row">
            <div class="col-md-10 ml-auto mr-auto">
                @if(auth()->user())
                    <a role="button" class="btn btn-link" href="{{ route('posts.create') }}">
                        Создать статью
                    </a>
                @endif
                <br>
                @foreach($posts as $post)
                    @php /** @var \App\Post $post */ @endphp
                    <div class="card card-plain card-blog">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card-image">
                                    <img class="img img-raised rounded"
                                         src="{{ preg_match('/^http/', $post->image) ? $post->image : asset(Storage::url($post->image)) }}" >
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h3 class="card-title">
                                    <a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ ucfirst($post->name) }}</a>
                                </h3>
                                <p class="card-description">
                                        @php $text = substr($post->description, 0, 300) @endphp
                                    {{ $text }} @if(strlen($text) < strlen($post->description)) <a href="{{ route('posts.show', ['id' => $post->id]) }}"> ... Read
                                        More </a> @endif
                                </p>

                                <div class="author">
                                    <img src="{{ $post->user->avatar ?? '/img/default_avatar.jpg'}}" alt="..."
                                         class="avatar img-raised">
                                    <span>{{ $post->user->name ?? '' }}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $posts->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>

@endsection



