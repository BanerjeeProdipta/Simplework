<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ('Create New Article') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="http://unpkg.com/turbolinks"></script> 
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <h1><a class="navbar-brand" href="{{ url('/') }}"class=" text-white">
            {{ ('SIMPLEWORK') }}
        </a></h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <a href="/about" class=" text-white" title="">About Us</a>
                <a href="/articles" class=" text-white" title="">Articles</a>
                <a href="/login" class=" text-white" title="">Create Article</a>
                <a href="/contact" class=" text-white" title="">Contact Us</a>
                <a href="/payment" class=" text-white" title="">Payment</a>
                <a href="/notification" class=" text-white" title="">Notification</a>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="dropdown dropdown-notifications">
                      <a href="#notifications-panel" data-toggle="dropdown" >
                        <i data-count="0" class="nav-link"> New Article (<span class="notif-count">0</span>)</i>
                      </a>
                      <div class="dropdown-container">                                
                        <ul class="dropdown-menu">
                        </ul>
                      </div>
                    </li>
                    <li class="dropdown dropdown-comment">
                        @forelse ($unreadNotifications as $notification)
                                {{$unreadNotifications -> markAsRead()}}
                            @if( $notification->type == 'App\Notifications\ArticleReply')
                                <a href="#comment-panel" data-toggle="dropdown" >
                                    <i comment-data-count={{$unreadNotifications->count()}} class="nav-link"> New Comment (<span class="comment-count">{{$unreadNotifications->count()}}</span>)</i>
                                </a>
                                <div class="dropdown-container">
                                    <ul class="dropdown-menu">
                                        <li class="notification active px-3">
                                            <div class="media">
                                                <div class="media-body">
                                                <a href="/articles/{{$notification->data['article_id'] }}">
                                                <strong>{{$notification->data['commenter'] }}</strong> commented <strong>{{$notification->data['reply'] }}</strong> on <strong>{{$notification->data['article'] }}</strong>
                                                </a>
                                                <div class="notification-meta">
                                                    <small class="timestamp">about a minute ago</small>
                                                </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/profile" >{{ __('My profile') }}</a>
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
            </ul>
        </div>
    </div>
</nav>

@auth
<script>
    var userId = {{ auth()->id() }};
</script>    
@endauth
<script type="text/javascript" src="{{ asset('js/new-article.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/new-comment.js') }}" ></script>