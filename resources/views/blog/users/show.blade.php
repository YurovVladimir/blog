@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/comment.js') }}" defer></script>
@endsection

@section('content')
    <div class="profile-page">

        <div class="wrapper">

            <div class="page-header page-header-small" filter-color="orange">

                <div class="page-header-image" data-parallax="true"
                     style="background-image: url('/img/bg5.jpg'); transform: translate3d(0px, 0px, 0px);">
                </div>
                <input type="hidden" id="user_id" value="{{ $user->id }}">
                <div class="content-center">
                    <div class="photo-container">
                        <div class="media media-post">
                            <img class="media-object img-raised"
                                 src="{{ isset($user->avatar) ? Storage::url($user->avatar) : '/img/default_avatar.jpg'}}"
                                 alt="">
                        </div>
                    </div>

                    <h3 class="title">{{ $user->name }}</h3>
                    <p class="category">Photographer</p>

                    <div class="content">
                        <div class="social-description">
                            <h2>{{ $user->posts->count() }}</h2>
                            <p>Posts</p>
                        </div>
                        <div class="social-description">
                            <h2>26</h2>
                            <p>Followers</p>
                        </div>
                        <div class="social-description">
                            <h2>{{ $user->comments->count() }}</h2>
                            <p>Comments</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="section">
                <div class="container">
                    <div class="button-container">
                        <a href="#button" class="btn btn-primary btn-round btn-lg">Follow</a>
                        <a href="#button" class="btn btn-warning btn-round btn-lg btn-icon last_post" rel="tooltip"
                           data-original-title="Show last post">
                            <i class="fa fa-newspaper-o"></i>
                        </a>
                        <a href="#button" class="btn btn-warning btn-round btn-lg btn-icon" rel="tooltip"
                           data-original-title="Show all posts">
                            <i class="fa fa-tasks"></i>
                        </a>
                    </div>

                    <h3 class="title">About me</h3>
                    @if(auth()->user() && auth()->user()->id == $user->id)
                        <div align="right">
                            <a role="button" class="btn btn-default btn-round btn-simple btn-icon"
                               href="{{ route('users.edit', ['id' => $user->id]) }}" rel="tooltip"
                               data-original-title="Edit my profile">
                                <i class="fa fa-user-circle"></i>
                            </a>
                        </div>
                    @endif
                    <h5 class="description text-center">{{ $user->description }}</h5>

                </div>

            </div>

        </div>
    </div>
@endsection

