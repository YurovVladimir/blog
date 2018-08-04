@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach($posts as $post)
                        <div class="">
                            <h2 class="text-center">
                                {{$post->name}}
                            </h2>
                            <blockquote class="blockquote text-right">


                                <p class="mb-0">
                                    {{ $post->description }}
                                </p>
                                <h6>
                                    <footer class="blockquote-footer">{{$post->user->name}}
                                    </footer>

                                </h6>
                            </blockquote>
                            <a class="btn btn-outline-dark btn-lg btn-block"
                               href="{{ route('posts.show', ['id' => $post->id]) }}" role="button">
                                Читать
                            </a>
                        </div>
                    @endforeach
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
