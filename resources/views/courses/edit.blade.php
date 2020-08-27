@extends('layouts.app')
@section('content')
    <h1>Edit Course</h1>
    @include('errors')
    <div class="container">
        <form action="{{ route('courses.update',['course'=>$course ]) }}" method="post">
            @method('PUT')
            @csrf
            <div class="">
                <div class="form-group col-md-6">
                    <label for="">Name</label>
                    <input type="text"  placeholder="Name" name="name" class="form-control" value="{{$course->name}}">
                </div>

                <div class="form-group col-md-6">
                    <label for="start_date">Start Date</label>
                    <input type="date" placeholder="Start Date" name="start_date" class="form-control" value="{{$course->start_date}}">
                </div>

                <div class="form-group col-md-6">
                    <label for="end_date">End Date</label>
                    <input type="date" placeholder="End Date" name="end_date" class="form-control" value="{{$course->end_date}}">
                </div>
            </div>


            <button type="submit" class="btn btn-primary" >Edit</button>
        </form>
    </div>
@endsection('content')
