@extends('layouts.app')
@section('content')
    <div class="profile-page">

        <div class="wrapper">

            <div class="page-header page-header-small" filter-color="orange" >

                <div class="page-header-image" data-parallax="true"
                     style="background-image: url('/img/bg5.jpg'); transform: translate3d(0px, 0px, 0px);">
                </div>
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
                            <h2>10</h2>
                            <p>Comments</p>
                        </div>
                        <div class="social-description">
                            <h2>26</h2>
                            <p>Likes</p>
                        </div>
                        <div class="social-description">
                            <h2>2</h2>
                            <p>Posts</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="section">
                <div class="container">
                    <div class="button-container">
                        <a href="#button" class="btn btn-primary btn-round btn-lg">Follow</a>
                        <a href="#button" class="btn btn-default btn-round btn-lg btn-icon" rel="tooltip" title=""
                           data-original-title="Follow me on Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="#button" class="btn btn-default btn-round btn-lg btn-icon" rel="tooltip" title=""
                           data-original-title="Follow me on Instagram">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>

                    <h3 class="title">About me</h3>
                    <h5 class="description text-center">An artist of considerable range, Ryan — the name taken by
                        Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own
                        music, giving
                        it a warm, intimate feel with a solid groove structure. An artist of considerable range.</h5>

                </div>

            </div>

        </div>
    </div>
@endsection

