@extends('layouts.app')
<?php use App\Constants\UserTypes; ?>
@section('content')
    <h1>Add Admin to Group "{{$group->name}}"</h1>
    @include('errors')
    <div class="container">
        <form action="{{route('group.users.store',['group'=>$group])}}" method="POST">
            @csrf
            <input type="hidden" name="group_id" value="{{ $group->id }}">
            <div class="">
                <div class="form-group col-md-4">
                    <label for="inputType">Type</label>
                    <select name='user' id="inputType" class="form-control" >
                        <option value="" selected disabled>Choose an Option...</option>
                        @foreach($admins as $admin)
                            @if(UserTypes::getOne($admin->type)=='Admin')
                                <option value="{{ $admin->id }}" @if (old('user')==$admin->id)  selected @elseif (request("user") == $admin->id) selected  @endif>{{ $admin->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            <button id='submit'  type="submit" class="btn btn-primary" >Add</button>
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
                {{--url: "{{ route('admins.groups.check',['admin'=>$admin,'group'=>$group])  }}",--}}
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
