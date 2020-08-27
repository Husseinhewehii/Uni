@extends('layouts.app')

<?php use App\Constants\UserTypes; ?>
@section('content')
    <h1>Edit Group</h1>
    @include('errors')
    <div class="container">
        <form action="{{ route('groups.update',['group'=>$group]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="">
                <div class="form-group col-md-6">
                    <label for="">Name</label>
                    <input type="text" placeholder="Name" name="name" class="form-control" value="{{$group->name}}">
                </div>
            </div>

            <div class="">
                <div class="form-group col-md-4">
                    <label for="inputType">Status</label>
                    <select name='status' id="inputType" class="form-control" >
                        <option value="" selected disabled>Choose an Option...</option>
                        <option value=1 @if ($group->status == 1) selected @endif>Activated</option>
                        <option value=2 @if ($group->status == 2) selected @endif>Deactivated</option>
                    </select>
                </div>
            </div>


            <button type="submit" class="btn btn-primary" >Create</button>
        </form>
    </div>

@endsection('content')
