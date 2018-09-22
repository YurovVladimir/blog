@extends('layouts.app')

@section('content')
    <div class="container" style="position: relative; top: 10vh">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form class="my-margin" method="post" action="{{ route('posts.update',['id' => $post->id]) }}"
                          enctype="multipart/form-data">
                        @csrf
                        {{ method_field('patch') }}
                        <div class="form-group">
                            <label for="nameInput">Название</label>
                            <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                   id="nameInput" value="{{ $post->name }}"
                                   placeholder="Название статьи">
                            @if ($errors->has('name'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="descriptionInput">Статья</label>
                            <textarea class="form-control  {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                      id="descriptionInput" name="description" rows="3">{{ $post->description }}</textarea>
                            @if ($errors->has('description'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="postTypeSelect">Тип статьи</label>
                            <select class="form-control  {{ $errors->has('post_type_id') ? ' is-invalid' : '' }}"
                                    id="postTypeSelect" name="post_type_id">
                                @foreach(\App\Models\PostType::all() as $post_type)
                                    <option value="{{ $post_type->id }}">{{ $post_type->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('post_type_id'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('post_type_id') }}
                                </div>
                            @endif
                        </div>
                        <img src="{{ preg_match('/^http/', $post->image) ? $post->image : asset(Storage::url($post->image)) }}"
                             class="img-fluid">
                        <hr class="my-4">
                        <div class="form-group">
                            <div class="btn btn-raised btn-round btn-default btn-file">
                                <i class="fa fa-file-image-o"></i>
                                <label for="exampleFormControlFile1" style="margin-bottom: 0">Прикрепить файл</label>
                            </div>
                            <input type="file"
                                   class="form-control-file {{ $errors->has('image') ? ' is-invalid' : ''  }}"
                                   name="image" id="imageInput">
                            @if ($errors->has('image'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                        </div>
                        <div align="center">
                            <button class="btn btn-default btn-round btn-lg" type="submit">
                                <i class="fa fa-undo"></i> Готово
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection