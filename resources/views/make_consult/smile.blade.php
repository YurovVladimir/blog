@extends('layouts.app')

@section('js')
    <!-- Scripts -->
    <script src="{{ asset('js/smile.js') }}" defer></script>
@endsection

@section('css')
    <style>
        html, body  {
            color: #000000;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <form>
            <div class="form-group">
                <input class="form-control" id="smile">
                <div class="alert alert-success" role="alert" id="result">

                </div>
            </div>
        </form>
    </div>
@endsection
