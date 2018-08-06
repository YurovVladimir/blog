@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form class="my-margin" method="POST" action="{{ route('posts.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nameInput">Название</label>
                            <input class="form-control" name="name" id="nameInput"
                                   placeholder="Название статьи">
                        </div>
                        <div class="form-group">
                            <label for="descriptionInput">Статья</label>
                            <textarea class="form-control" id="descriptionInput" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="postTypeSelect">Example select</label>
                            <select class="form-control" id="postTypeSelect" name="post_type_id">
                                @foreach(\App\PostType::all() as $post_type)
                                    <option value="{{ $post_type->id }}">{{ $post_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-outline-dark btn-lg btn-block">Создать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
