<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Latest compiled and minified CSS -->

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">--}}

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css" />
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    @yield('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->

    <style>
        a>#disabled{
            pointer-events: none;
            cursor: default;

        }
        #list:hover{
            background: #1b1e21;
            padding: 5px;
            clear: both;
            color:black;
            zoom: 1.2;
              text-decoration: none;
        }
        #nicecardheading
        {
            background: #202326!important;
            color:white!important;
        }
        #cardborder
        {
            border: 2px dotted #212529;
        }
    </style>


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img style="border:1px solid darkgreen" height="30px" width="30px" src="{{Auth::user()->avatar}}" alt="">&nbsp;{{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
        <div class="container">
            @include('includes.error')
        </div>
        <main class="py-4">
            <div class="container">
                <div class="row">

                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <ul class="list-group">
                                    <a href="{{url('/forum')}}">
                                        <li class="list-group-item">
                                            Home
                                        </li>
                                    </a>
                                    <a href="{{url('/forum?filter=me')}}">
                                        <li class="list-group-item">
                                            My discussions
                                        </li>
                                    </a>
                                    <a href="{{url('/forum?filter=solved')}}">
                                        <li class="list-group-item">
                                            Answered Questions
                                        </li>
                                    </a>
                                    <a href="{{url('/forum?filter=unsolved')}}">
                                        <li class="list-group-item">
                                            Unanswered Questions
                                        </li>
                                    </a>
                                    @if(Auth::check())
                                        @if(Auth::user()->admin)
                                            <a href="{{url('/channels')}}">
                                                <li class="list-group-item">
                                                    All Channels
                                                </li>
                                            </a>
                                            @endif
                                        @endif

                                </ul>
                            </div>
                        </div>
                        <br>

                        <a href="{{route('discussions.create')}}" class="btn btn-success btn-lg form-control">Create a new Discussion</a>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <br>
                                <h1>Channels <span class="fa fa-thumb-tack"></span><span class="pull-right"><a data-toggle="tooltip" title="Create new Channel" href="{{route('channels.create')}}"><i style="font-size: 30px" class="fa fa-plus-square"></i></a></span></h1>
                            </div>
                            <div class="panel-body">
                                <ul class="list-group" >
                                    @foreach($channels as $channel)
                                        <a id="list" class="makeactive" href="{{route('channel',['slug'=>$channel->slug])}}">
                                    <li class="list-group-item ">
                                        {{str_limit($channel->title,20)}}
                                        <span class="badge">
                                            @if($channel->discussions->count() >0)
                                            [{{$channel->discussions->count()}}]
                                                @else
                                                [empty]
                                               @endif
                                        </span>
                                    </li>
                                        </a>
                                        @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                <div class="col-md-8">
                    @yield('content')
                </div>
                </div>
             </div>

        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        @if(Session::has('info'))
        toastr.info('{{Session::get('info')}}');
        @elseif(Session::has('success'))
        toastr.success('{{Session::get('success')}}');
        @endif
        function using(){
            $(".makeactive").click(function(){
                $(this).addClass("active");
                // $().removeClass("active");
            });
        }
    </script>
@yield('scripts')
</body>
</html>
