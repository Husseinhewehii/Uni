@extends('layouts.app')
@section('content')
    <form action="{{route('sender')}}" method="POST">
        <input type="text" name="content">
        <input type="submit">
        {{ csrf_field() }}
    </form>
@endsection
