<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Uni</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs/dist/tf.min.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.0.0/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/body-pix@1.0.0"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styling.css') }}" rel="stylesheet">


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home')}}">
                    Home
                </a>

                {{--app()->getLocale()--}}
                {{--,['language'=>'en']--}}
                {{--)--}}
                <div class="dropdown">
                    <a class="navbar-brand " href="#">
                        {{ __('translations.users')}}
                    </a>
                    <ul class="nav-item dropdown-content bg-dark">
                        <li >
                            <a class="nav-link " href="{{ route('users.create') }}">Create</a>
                        </li>

                        <li >
                            <a class="nav-link " href="{{ route('users.index.students') }}">Students</a>
                        </li>

                        <li >
                            <a class="nav-link " href="{{ route('users.index.professors') }}">Professors</a>
                        </li>

                        <li >
                            <a class="nav-link " href="{{ route('users.index.admins') }}">Admins</a>
                        </li>

                    </ul>
                </div>


                    <div class="dropdown">
                        <a class="navbar-brand" href="{{route('courses.index' )}}">
                            {{ __('translations.courses')}}
                        </a>
                        @can('create',\App\Models\Course::class)
                            <li class="nav-item dropdown-content bg-dark">
                                <a class="nav-link " href="{{ route('courses.create') }}">Create</a>
                            </li>
                        @endcan
                    </div>



                @can('view',\App\Models\Group::class)
                <div class="dropdown">
                    <a class="navbar-brand" href="{{route('groups.index')}}">
                        Groups
                    </a>
                    @can('create',\App\Models\Group::class)
                        <li class="nav-item dropdown-content bg-dark">
                            <a class="nav-link " href="{{ route('groups.create') }}">Create</a>
                        </li>
                    @endcan

                </div>
                @endcan


                @can('view',\App\Models\Permission::class)
                    <div class="dropdown">
                        <a class="navbar-brand" href="{{route('permissions.index')}}">
                            Permissions
                        </a>
                    </div>
                @endcan




                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>



                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        {{--<div class="dropdown">--}}
                            {{--<a class="navbar-brand" href="{{route('translate')}}">--}}
                                {{--Translate--}}
                            {{--</a>--}}

                        {{--</div>--}}
                        <!-- Authentication Links -->
                        @guest
                            {{--<li class="nav-item">--}}
                                {{--<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
                            {{--</li>--}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('users.go.login')}}">Uni Login</a>
                            </li>
                            {{--@if (Route::has('register'))--}}
                                {{--<li class="nav-item">--}}
                                    {{--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                                {{--</li>--}}
                            {{--@endif--}}

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                    <a   href="{{route('users.password.go.change',['user'=>Auth::user()])}}"class="dropdown-item">
                                        Change Password
                                    </a>

                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fa fa-bell"></i>
                                        {{--<example-component>--}}
                                                {{--hi--}}
                                        {{--</example-component>--}}
                                        {{--<ringer>--}}
                                            {{--ringer is here--}}
                                        {{--</ringer>--}}
                                        @if(auth()->user()->unReadNotifications->count())
                                            <span class="badge badge-danger">{{auth()->user()->unReadNotifications->count()}}</span>
                                        @endif

                                    </a>
                                    <ol class="dropdown-menu">
                                        <li><a href="{{route('mark_read')}}" style="color:green;">Mark All as Read</a></li>
                                        @foreach(auth()->user()->unReadnotifications as $notification)
                                            <li style="background-color: #1b4b72"><a href="#" >{{$notification->data}}</a></li>
                                        @endforeach

                                        @foreach(auth()->user()->readNotifications as $notification)
                                            <li ><a href="#" >{{$notification->data}}</a></li>
                                        @endforeach
                                    </ol>
                            </li>
                            <li class="nav-link"><a href="{{route('send_notification')}}">Send Notification</a></li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        Echo.channel('home')
            .listen('.App\\Events\\BenachrichtigungEvent', (e) => {
                console.log('works');
                console.log(e);
            });
    </script>
    @yield('scripts')

</body>
</html>
