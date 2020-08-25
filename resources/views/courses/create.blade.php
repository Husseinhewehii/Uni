@extends('layouts.app')

@section('content')
    <h1>Create Course</h1>
    @include('errors')
    <div class="container">
        <form action="{{ route('courses.store') }}" method="POST">
            @csrf
            <div class="">
                <div class="form-group col-md-6">
                    <label for="">Course Name</label>
                    <input type="text" placeholder="Name" name="name" class="form-control" value="{{old('name')}}">
                </div>

                <div class="form-group col-md-4">
                    <label for="inputType">Professor Name</label>
                    <select name='professor_id' id="inputType" class="form-control" >
                        <option value="" selected disabled>Choose an Option...</option>

                        @foreach($professors as $professor)
                            <option value="{{ $professor->id }}" @if (old('professor')==$professor->id)  selected @elseif (request("user") == $professor->id) selected  @endif>{{ $professor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="start_date">Start Date</label>
                    <input type="date" placeholder="Start Date" name="start_date" class="form-control" value="{{old('start_date')}}">
                </div>

                <div class="form-group col-md-6">
                    <label for="end_date">End Date</label>
                    <input type="date" placeholder="End Date" name="end_date" class="form-control" value="{{old('end_date')}}">
                </div>
            </div>


            <button type="submit" class="btn btn-primary" >Create</button>
        </form>
    </div>
@endsection('content')
