@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>Laravel</title>

            <!-- Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


            {{--<!-- Styles -->--}}
            {{--<style type="application/javascript">--}}
                {{--html, body {--}}
                    {{--background-color: #fff;--}}
                    {{--color: #636b6f;--}}
                    {{--font-family: 'Nunito', sans-serif;--}}
                    {{--font-weight: 200;--}}
                    {{--height: 100vh;--}}
                    {{--margin: 0;--}}
                {{--}--}}

                {{--.full-height {--}}
                    {{--height: 100vh;--}}
                {{--}--}}

                {{--.flex-center {--}}
                    {{--align-items: center;--}}
                    {{--display: flex;--}}
                    {{--justify-content: center;--}}
                {{--}--}}

                {{--.position-ref {--}}
                    {{--position: relative;--}}
                {{--}--}}

                {{--.top-right {--}}
                    {{--position: absolute;--}}
                    {{--right: 10px;--}}
                    {{--top: 18px;--}}
                {{--}--}}

                {{--.content {--}}
                    {{--text-align: center;--}}
                {{--}--}}

                {{--.title {--}}
                    {{--font-size: 84px;--}}
                {{--}--}}

                {{--.links > a {--}}
                    {{--color: #636b6f;--}}
                    {{--padding: 0 25px;--}}
                    {{--font-size: 13px;--}}
                    {{--font-weight: 600;--}}
                    {{--letter-spacing: .1rem;--}}
                    {{--text-decoration: none;--}}
                    {{--text-transform: uppercase;--}}
                {{--}--}}

                {{--.m-b-md {--}}
                    {{--margin-bottom: 30px;--}}
                {{--}--}}
            {{--</style>--}}
        </head>
        <body>
            @if(session()->has('success'))
                {{session('success')}}
            @endif
            <div class="flex-center position-ref full-height">
                {{--@if (Route::has('login'))--}}
                    {{--<div class="top-right links">--}}
                        {{--@auth--}}
                            {{--<a href="{{ url('/home') }}">Home</a>--}}
                        {{--@else--}}
                            {{--<a href="{{ route('login') }}">Login</a>--}}

                            {{--@if (Route::has('register'))--}}
                                {{--<a href="{{ route('register') }}">Register</a>--}}
                            {{--@endif--}}
                        {{--@endauth--}}
                    {{--</div>--}}
                {{--@endif--}}


                {{--<a class="navbar-brand" href="{{route('welcome',app()->getLocale())}}">--}}
                    {{--Home--}}
                {{--</a>--}}

                {{--<div class="dropdown">--}}
                    {{--<a class="navbar-brand" href="{{route('translate',app()->getLocale())}}">--}}
                        {{--Translate--}}
                    {{--</a>--}}

                {{--</div>--}}
                <div class="content">
                    <div class="title m-b-md">
                        <h1>{{ __('translations.welcome') }}</h1>
                    </div>
                    @foreach (Config::get('app.locales') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <a href="{{ route(Route::currentRouteName(), array_merge( request()->route()->parameters(), ['lang' => $lang])) }}" class="dropdown-item d-flex align-items-center">
                                <div>
                                    <strong>{{$language}}</strong>
                                </div>
                            </a>
                        @endif
                    @endforeach

                    {{--<li class="nav-item"><a href="{{route(Route::currentRouteName(),'en')}}" class="nav-link">English</a></li>--}}
                    {{--<li class="nav-item"><a href="{{route(Route::currentRouteName(),'de')}}" class="nav-link">Deutsch</a></li>--}}
                </div>

                <example-component>  </example-component>

            </div>
        </body>
    </html>
@endsection


{{--<script>--}}
    {{--var client = AgoraRTC.createClient({mode: 'live', codec: "h264"});--}}

    {{--client.init(<APPID>, function () {--}}
        {{--console.log("AgoraRTC client initialized");--}}
    {{--}, function (err) {--}}
        {{--console.log("AgoraRTC client init failed", err);--}}
    {{--});--}}

        {{--localStream.init(function() {--}}
        {{--console.log("getUserMedia successfully");--}}
        {{--localStream.play('agora_local');--}}
        {{--}, function (err) {--}}
        {{--console.log("getUserMedia failed", err);--}}
        {{--});--}}



{{--</script>--}}
