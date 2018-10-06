@extends('layouts.app')

@section('content')
    <div class="container" style="position: relative; top: 10vh">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form class="my-margin" method="post" action="{{ route('users.update',['id' => $user->id]) }}"
                          enctype="multipart/form-data">
                        @csrf
                        {{ method_field('patch') }}
                        <div class="form-group">

                            <div class="form-group">
                                <label for="avatarImg"> Avatar: </label>
                                <div class="form-group">
                                    <img src="{{ isset($user->avatar) ? Storage::url($user->avatar) : '/img/default_avatar.jpg'}}"
                                         class="avatar"
                                         id="avatarImg">
                                    <input type="file"
                                           class="form-control-file {{ $errors->has('avatar') ? ' is-invalid' : ''  }}"
                                           name="avatar" id="imageInput">
                                    @if ($errors->has('avatar'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ $errors->first('avatar') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nameInput">Name</label>
                                <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                       id="nameInput" value="{{ $user->name }}">
                                @if ($errors->has('name'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>

                            <div class="about_me">
                                <label for="descriptionInput"> About me:</label>
                                <textarea class="form-control  {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                          id="descriptionInput" name="description"
                                          rows="3">{{ $user->description }}</textarea>
                                @if ($errors->has('description'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                            </div>

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