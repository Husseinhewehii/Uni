@extends('layouts.app')
@section('content')
    <h1>Add Course</h1>
    @include('errors')
    <div class="container">
        <form action="{{route('users.courses.store',['user'=>$user])}}" method="POST">
            @csrf
            <div class="">
                <div class="form-group col-md-4">
                    <label for="inputType">Type</label>
                    <select name='course' id="inputType" class="form-control" >
                        <option value="" selected disabled>Choose an Option...</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" @if (old('course')==$course->id) selected @endif>{{$course->name}}</option>
                        @endforeach
                    </select>
                </div>
            <button id='submit' onclick="popIt()" type="submit" class="btn btn-primary" >Add</button>
        </form>
    </div>

    {{--<script>--}}
        {{--function popIt() {--}}
            {{--alert('thank you')--}}
        {{--}--}}
    {{--</script>--}}

@endsection('content')
