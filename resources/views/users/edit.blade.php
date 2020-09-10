@extends('layouts.app')
<?php use App\Constants\UserTypes; ?>
@section('content')
    <h1>Edit Account</h1>
    @include('errors')
    <div class="container">
        <form action="{{ route('users.update',['user'=>$user]) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="">Name</label>
                    <input type="text" placeholder="Name" name="name" class="form-control" value="{{$user->name}}">
                </div>

                <div class="form-group col-md-6">
                    <label for="">Image</label>
                    <div class="container">
                        <img style="width:120px; height: 80px;" src="{{asset($user->image)}}" alt="No Image">
                        <input type="file" placeholder="Image" name="image"  value="{{$user->image}}">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="inputPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" >
                </div>

                <div class="form-group col-md-6">
                    <label for="inputConfirmPassword">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="inputPassword" placeholder="Confirm Password">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputDate">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" id="inputDate" value="{{$user->date_of_birth}}">
                </div>

                <div class="form-group col-md-4">
                    <label for="inputGender">Gender</label>
                    <select name='gender' id="inputGender" class="form-control" value="{{$user->gender}}">
                        <option selected disabled>Choose an Option...</option>
                        <option value="1" @if($user->gender == 1) selected @endif>Male</option>
                        <option value="2" @if($user->gender == 2) selected @endif>Female</option>
                    </select>
                </div>
                {{--@if(UserTypes::getOne($user->type) == 'Admin')--}}
                    <div class="form-group col-md-4">
                        <label for="inputType">Type</label>
                        <select name='type' id="inputType" class="form-control" >
                            <option value="" selected disabled>Choose an Option...</option>
                            @foreach(UserTypes::getList() as $key => $value)
                                    <option value="{{ $key }}" @if ($user->type==$key) selected  @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                {{--@endif--}}
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection('content')
