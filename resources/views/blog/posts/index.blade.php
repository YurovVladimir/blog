@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach($posts as $post)
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-center card-title">
                                    {{ ucfirst($post->name) }}
                                </h2>
                                <div class="card-text text-right">
                                    <p class="mb-0">
                                        {{ substr($post->description, 0, 20) }}
                                    </p>
                                    <h6>
                                        {{ $post->user->name }}
                                    </h6>
                                </div>
                                <a class="btn btn-outline-dark btn-lg btn-block"
                                   href="{{ route('posts.show', ['id' => $post->id]) }}" role="button">
                                    Подробнее
                                </a>
                            </div>
                        </div>
                    @endforeach
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
