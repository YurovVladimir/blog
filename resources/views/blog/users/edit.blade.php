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
                            <label for="descriptionInput">О себе:</label>
                            <textarea class="form-control  {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                      id="descriptionInput" name="description" rows="3">{{ $user->description }}</textarea>
                            @if ($errors->has('description'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('description') }}
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