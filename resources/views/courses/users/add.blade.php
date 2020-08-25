@extends('layouts.app')
<?php use App\Constants\UserTypes; ?>
@section('content')
    <h1>Add Student</h1>
    @include('errors')
    <div class="container">
        <form action="{{route('courses.users.store',['course'=>$course])}}" method="POST">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <div class="">
                <div class="form-group col-md-4">
                    <label for="inputType">Type</label>
                    <select name='user' id="inputType" class="form-control" >
                        <option value="" selected disabled>Choose an Option...</option>
                        @foreach($users as $user)
                            @if(UserTypes::getOne($user->type)=='Student')
                                <option value="{{ $user->id }}" @if (old('user')==$user->id) selected @endif>{{$user->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            <button id='submit' onclick="popIt()" type="submit" class="btn btn-primary" >Add</button>
                <br>

        </form>

    </div>
    <div class="alert alert-success" style="display:none;"></div>
    {{--<script>--}}
        {{--function popIt() {--}}
            {{--alert('thank you')--}}
        {{--}--}}
    {{--</script>--}}

@endsection('content')
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg==" crossorigin="anonymous"></script>--}}
{{--<script>--}}
    {{--$(document).ready(function(){--}}
        {{--$('#submit').click(function(e){--}}

            {{--// console.log('submitted');--}}
            {{--e.preventDefault();--}}
            {{--$.ajaxSetup({--}}
                {{--headers:{--}}
                    {{--'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')--}}
                {{--}--}}
            {{--});--}}

            {{--$.ajax({--}}
                {{--url: "{{ route('users.courses.check',['user'=>$user,'course'=>$course])  }}",--}}
                {{--method: 'POST',--}}
                {{--// data: {file: $("file").val()},--}}

                {{--success: function(result){--}}
                    {{--$(".alert").show();--}}
                    {{--$(".alert").html('Course Registered');--}}
                    {{--$(".alert").html(result);--}}
                {{--},--}}

            {{--});--}}
        {{--});--}}
    {{--});--}}
{{--</script>--}}
