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
                    @php /** @var \App\Models\Post $post */ @endphp
                    <div class="card card-plain card-blog">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card-image">
                                    <img class="img img-raised rounded"
                                         src="{{ isset($post->image) ? asset(Storage::url($post->image)) : '/img/default_image.jpg'}}" >
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h3 class="card-title" style="margin-top: 0; margin-bottom: 0">
                                    <a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ ucfirst($post->name) }}</a>
                                </h3>
                                <p class="card-description">
                                        @php $text = substr($post->description, 0, 200) @endphp
                                    {{ $text }} @if(strlen($text) < strlen($post->description)) <a href="{{ route('posts.show', ['id' => $post->id]) }}"> ... Read
                                        More </a> @endif
                                </p>

                                <div class="author">
                                    <img src="{{ isset($post->user->avatar) ? Storage::url($post->user->avatar) : '/img/default_avatar.jpg'}}" alt="..."
                                         class="avatar img-raised">
                                        <a href="{{ isset($post) ? route('users.show', ['id' => $post->user->id]) : '' }}">
                                        <span>{{ $post->user->name ?? '' }}</span>
                                        </a>
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
