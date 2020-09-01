@extends('layouts.app')
<?php use App\Constants\UserTypes; ?>
@section('content')
    @include('errors')
    <h2>Password Reset Link has been sent to your Email: {{$email}}</h2>
@endsection('content')
