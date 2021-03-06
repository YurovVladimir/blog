<nav class="navbar navbar-expand-lg bg-white fixed-top navbar-transparent text-white" color-on-scroll="20" >
    <div class="container">

        <div class="navbar-translate text-white">
            <ul class="navbar-nav ml-auto">
               <li class="nav-item" data-background-color="black">
                <a class="nav-link" href="/" rel="tooltip" title="" data-placement="bottom">
                    {{ config('app.name', 'Home page') }}
                </a>
               </li>
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                    aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse has-image text-white" id="navigation" data-color="orange"
             data-nav-image="/img/blurred-image-1.jpg">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item" data-background-color="black">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item" data-background-color="black">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown" data-background-color="black">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('users.show', auth()->user()->slug) }}"> My
                                profile </a>
                            <a class="dropdown-item" href="{{ route('posts.create') }}"> Create post </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                <li class="nav-item" data-background-color="black">
                    <a class="nav-link" href="{{ url('/posts') }}">Show posts</a>
                </li>
            </ul>
        </div>
    </div>
</nav>