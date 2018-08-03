@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <ul>
                    @foreach($posts as $post)
                        <h2>
                            {{$post->name}}
                        </h2>
                        <h6>
                            {{$post->user->name}}
                        </h6>
                        {{ $post->description }}
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
