<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Uni</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs/dist/tf.min.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.0.0/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/body-pix@1.0.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>


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


                <a href="https://wa.me/+201111353067" class="btn"><i class="fa fa-whatsapp"></i></a>

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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle  " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div id='user_auth_dropdown' class="dropdown-menu dropdown-menu-right dropdown-content" aria-labelledby="navbarDropdown">
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

                            {{--<li class="nav-item dropdown" >--}}
                                    {{--<a id="navbarDropdown"  class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
                                        {{--<i class="fa fa-bell"></i>--}}

                                        {{--@if(auth()->user()->unReadNotifications->count())--}}
                                            {{--<span class="badge badge-danger">{{auth()->user()->unReadNotifications->count()}}</span>--}}
                                        {{--@endif--}}

                                    {{--</a>--}}
                                    {{--<ol class="dropdown-content" id='user_auth_dropdown'>--}}
                                        {{--<li><a href="{{route('mark_read')}}" style="color:green;">Mark All as Read</a></li>--}}
                                        {{--@foreach(auth()->user()->unReadnotifications as $notification)--}}
                                            {{--<li style="background-color: #1b4b72"><a href="#" >{{$notification->data}}</a></li>--}}
                                        {{--@endforeach--}}

                                        {{--@foreach(auth()->user()->readNotifications as $notification)--}}
                                            {{--<li ><a href="#" >{{$notification->data}}</a></li>--}}
                                        {{--@endforeach--}}
                                    {{--</ol>--}}
                            {{--</li>--}}
                            {{--<li class="nav-link"><a href="{{route('send_notification')}}">Send Notification</a></li>--}}
                                <li class="nav-item dropdown" >
                                    <a id="navbarDropdown"  class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fa fa-bell"></i>
                                        {{--@if(auth()->user()->unReadNotifications->count())--}}
                                            {{--<span class="badge badge-danger">{{auth()->user()->unReadNotifications->count()}}</span>--}}
                                        {{--@endif--}}
                                        {{--<span class="badge badge-danger" v-once="notifications_count">@{{ notifications_count}}</span>--}}
                                    </a>
                                    <ol class="dropdown-content" id='user_auth_dropdown'>
                                        <li><a href="{{route('mark_read')}}" style="color:green;">Mark All as Read</a></li>
                                        <div v-for="notification in notifications">
                                            <li>@{{ notification.data }}</li>
                                        </div>
                                    </ol>
                                </li>
                                {{--<li class="nav-link"><a href="{{route('notifications.go.send')}}">Send Notification</a></li>--}}
                            <li class="nav-link"><button @click.prevent="postNotification">Send Notification</button></li>


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
        const app = new Vue({
            el: '#app',
            data: {
                notifications: {},
                notifications_count:0,
                user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!}
            },
            mounted(){
                this.getNotifications();
                this.listen();
            },
            methods:{
                getNotifications(){
                    axios.get('/api/users/'+this.user.id+'/notifications')
                        .then((response) => {
                            this.notifications = response.data
                        })
                        .catch(function(error){
                            console.log(error);
                        });
                },
                postNotification(){
                    axios.get('api/send-notification/'+this.user.id)
                        .then((response) => {
                            // this.notifications.unshift(response.data)
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                listen(){
                    Echo.channel('navigation')
                        .listen('BenachrichtigungEvent', (notification) => {

                            this.notifications.unshift({'data':notification['data']});
                            this.notifications_count = notification['notifications_count'];

                            console.log(notification['data']);
                            console.log(this.notifications_count);

                        });
                }
            }
        });


    </script>
    @yield('scripts')

</body>
</html>
