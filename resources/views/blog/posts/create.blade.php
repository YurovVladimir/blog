@extends('layouts.app')

@section('content')
    <div class="container" style="position: relative; top: 13vh">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form class="my-margin" method="POST" action="{{ route('posts.store') }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nameInput">Название</label>
                            <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                   id="nameInput" value="{{ old('name') }}"
                                   placeholder="Название статьи">
                            @if ($errors->has('name'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="descriptionInput">Статья</label>
                            <textarea class="form-control  {{ $errors->has('description') ? ' is-invalid' : '' }}" id="descriptionInput" name="description" rows="3">{{ old('description') }}</textarea>
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
                            <i class="fa fa-floppy-o"></i> Создать
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
