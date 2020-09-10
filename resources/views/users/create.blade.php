@extends('layouts.app')

<?php use App\Constants\UserTypes; ?>
@section('content')
    <h1>Create Account</h1>
    @include('errors')
    <div class="container">
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="">
                <div class="form-group col-md-6">
                    <label for="">Profile Image</label>
                    <input type="file" placeholder="Upload Image" name="image" class="form-control" >
                </div>
                <div class="form-group col-md-6">
                    <label for="">Name</label>
                    <input type="text" placeholder="Name" name="name" class="form-control" value="{{old('name')}}">
                </div>

                <div class="form-group col-md-6">
                    <label for="">Email</label>
                    <input type="email" placeholder="Email" name="email" class="form-control" value="{{old('email')}}">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputConfirmPassword">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="inputPassword" placeholder="Confirm Password">
                </div>
            </div>

            <div class="">
                <div class="form-group col-md-6">
                    <label for="inputDate">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" id="inputDate" value="{{old('date_of_birth')}}">
                </div>

                <div class="form-group col-md-4">
                    <label for="inputGender">Gender</label>
                    <select name='gender' id="inputGender" class="form-control" >
                        <option selected value="" disabled>Choose an Option...</option>
                        <option value="1" @if (old('type')==1) selected @endif>Male</option>
                        <option value="2" @if (old('type')==2) selected @endif>Female</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputType">Type</label>
                    <select name='type' id="inputType" class="form-control" >
                        <option value="" selected disabled>Choose an Option...</option>
                        @foreach(UserTypes::getList() as $key => $value)
                            <option value="{{ $key }}" @if (old('type')==$key) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <button type="submit" class="btn btn-primary" >Create</button>
        </form>
    </div>

@endsection('content')
