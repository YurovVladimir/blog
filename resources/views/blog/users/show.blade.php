@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/comment.js') }}" defer></script>
@endsection
<script>
    function showPostAlert() {
        var loot = $(#post).value();
        swall({
            title: 'Sweet!',
            text: (loot),
            imageUrl: 'https://unsplash.it/400/200',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
            animation: false
        });
    }
</script>

@section('content')
    <div class="profile-page">
        <div class="wrapper">
            <div class="page-header page-header-small" filter-color="orange">
                <div class="page-header-image" data-parallax="true"
                     style="background-image: url('/img/bg5.jpg'); transform: translate3d(0px, 0px, 0px);">
                </div>
                <input type="hidden" id="user_id" value="{{ $user->id }}">
                <input type="hidden" id="post" value="{{ $user->posts->last()->name }}">
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

            {{--About me--}}
            <div class="section">
                <div class="container">
                    <div class="button-container">
                        <a href="#button" class="btn btn-primary btn-round btn-lg">Follow</a>
                        <a class="btn btn-warning btn-round btn-lg btn-icon last_post" rel="tooltip"
                           data-original-title="Show last post" onclick="showPostAlert()">
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

                    {{--Portfolio--}}
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="title text-center">Portfolio</h4>
                            <div class="nav-align-center">
                                <ul class="nav nav-pills nav-pills-info nav-pills-just-icons" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#profile" role="tablist"
                                           rel="tooltip" data-original-title="All posts">
                                            <i class="fa fa-newspaper-o"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#home" role="tablist"
                                           rel="tooltip" data-original-title="All comments">
                                            <i class="now-ui-icons location_world"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#messages" role="tablist">
                                            <i class="now-ui-icons design-2_ruler-pencil"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Tab panes -->
                            <div class="tab-content gallery">
                                <div class="tab-pane active" id="profile" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach ($user->posts as $post)
                                                <div class="card card-plain card-blog">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="card-image" align="center">
                                                                <img class="img img-raised rounded"
                                                                     src="{{ isset($post->image) ? asset(Storage::url($post->image)) : '/img/default_image.jpg'}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <h3 class="card-title">
                                                                <a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ ucfirst($post->name) }}</a>
                                                            </h3>
                                                            <p class="card-description">
                                                                @php $text = substr($post->description, 0, 300) @endphp
                                                                {{ $text }} @if(strlen($text) < strlen($post->description))
                                                                    <a href="{{ route('posts.show', ['id' => $post->id]) }}">
                                                                        ... Read
                                                                        More </a> @endif
                                                            </p>
                                                            <div class="author">
                                                                <img src="{{ isset($post->user->avatar) ? Storage::url($post->user->avatar) : '/img/default_avatar.jpg'}}"
                                                                     alt="..."
                                                                     class="avatar img-raised">
                                                                <a href="{{ isset($post) ? route('users.show', ['id' => $post->user->id]) : '' }}">
                                                                    <span>{{ $post->user->name ?? '' }}</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="home" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach($user->comments->sortByDesc('id') as $comment)
                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-8">
                                                        <h2 class="card-title text-black"  align="center">
                                                            <a class="text-black" href="{{ route('posts.show', ['id' => $comment->post->id]) }}">{{ ucfirst($comment->post->name) }}</a>
                                                        </h2>
                                                        <div class="card section-comments"
                                                             data-comment_id="{{ $comment->id ?? 0}}">
                                                            <div class="media-area card-body">
                                                                <div class="media">
                                                                    <a class="pull-left nav-link"
                                                                       href="{{ isset($comment) ? route('users.show', ['id' => $comment->user->id]) : '' }}">
                                                                        <div class="avatar">
                                                                            <img class="media-object img-raised avatar"
                                                                                 alt="64x64"
                                                                                 src="{{isset($comment->user->avatar) ? Storage::url($comment->user->avatar) : '/img/default_avatar.jpg'}}">
                                                                        </div>
                                                                    </a>
                                                                    <div class="media-body">

                                                                        <h5 class="media-heading">
                                                                            <a href="{{ isset($comment) ? route('users.show', ['id' => $comment->user->id]) : '' }}">
                                                                                <font style="vertical-align: inherit;">{{ $comment->user->name ?? auth()->user()->name ?? '' }}
                                                                                </font>
                                                                            </a>
                                                                            <small class="text-muted">
                                                                                <font style="vertical-align: inherit;">
                                                                                    {{ isset($comment) ? $comment->created_at->diffForHumans() : '' }}
                                                                                </font>
                                                                            </small>
                                                                        </h5>
                                                                        <font style="vertical-align: inherit;">
                                                                            {{ $comment->text ?? '' }}
                                                                        </font>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <div style="position: absolute; bottom: 5px; right: 7px">
                                                                        <button class="btn btn-info btn-round btn-sm liked"
                                                                                data-comment_id="{{ $comment->id ?? 0 }}">
                                                                            <i class="fa @if(auth()->user() && isset($comment) && $comment->likes->where('user_id',
                                                                                 \auth()->user()->id)->where('is_liked', true)->count()) text-danger fa-heart
                                                                                @else text-default fa-heart-o @endif"
                                                                               aria-hidden="false"></i>
                                                                            <span class="count">{{ isset($comment) ? $comment->likes->where('is_liked', true)->count() : '' }}</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="messages" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="info info-horizontal">
                                            <div class="icon icon-info">
                                                <i class="now-ui-icons design_palette"></i>
                                            </div>
                                            <div class="description">
                                                <h5 class="info-title">Colors adjustments</h5>
                                                <p class="description">
                                                    Gain access to the demographics, psychographics, and location of
                                                    unique people who talk about your brand.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="info info-horizontal">
                                            <div class="icon icon-info">
                                                <i class="now-ui-icons design_scissors"></i>
                                            </div>
                                            <div class="description">
                                                <h5 class="info-title">Performance Clothing</h5>
                                                <p class="description">
                                                    Unify data from Facebook, Instagram, Twitter, LinkedIn, and
                                                    Youtube to gain rich insights from easy-to-use reports.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

