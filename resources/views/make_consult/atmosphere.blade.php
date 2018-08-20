@extends('layouts.app')

@section('css')
    <style>
        html, body {
            color: #000000;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        window.onload = function() {
            $('input[name=height]').val(window.innerHeight);
            $('input[name=width]').val(window.innerWidth);
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <form class="my-margin" method="POST" action="{{ route('uploadFile') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="height">
            <input type="hidden" name="width">
            <div class="form-group">
                <input type="file" name="file" class="form-control">
                @if ($errors->has('file'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('file') }}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-outline-dark btn-lg btn-block">Загрузить</button>
        </form>
    </div>
@endsection
