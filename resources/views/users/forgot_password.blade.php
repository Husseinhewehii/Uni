@extends('layouts.app')
<?php use App\Constants\UserTypes; ?>
@section('content')
    <h1>Forgot Password</h1>
    @include('errors')
    <div class="container">
        <form method="POST" action="{{route('users.password.reset.link')}}" >
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Email</label>
                    <input type="text" placeholder="Email" name="email" class="form-control" value="{{old('email')}}">
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Send Reset Link</button>
        </form>
    </div>
@endsection('content')
