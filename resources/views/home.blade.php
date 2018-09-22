@extends('layouts.app')

@section('content')
<div class="container" style="position: relative; top: 10vh">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body" align="center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                        <hr class="my-4">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
