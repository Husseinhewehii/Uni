@extends('layouts.app')

@section('content')
    <h1>Edit Review</h1>
    @include('errors')
    <div class="container">
        <form action="{{route('course.reviews.update',['course'=>$course, 'review' => $review])}}" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
            <div class="">
                <div class="form-group col-md-4">
                    <label for="inputType">Rate The Course:</label>
                    <select name="rate" id="inputType" class="form-control" >
                        <option value="" selected disabled>Choose an Option...</option>
                        @for($x = 1; $x <= 5; $x++)
                            <option value="{{$x}}" @if(old('rate') == $x) selected @elseif($review->rate == $x) selected @endif >{{$x}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="textAreaType">Comment:</label>
                    <textarea placeholder="Leave Your Comment Here:" name="comment"  class="form-control"
                               cols="30" rows="10">{{$review->comment ? $review->comment : old('comment')}}</textarea>
                </div>
            </div>


            <button type="submit" class="btn btn-primary" >Edit Review</button>
        </form>
        <button style="margin:5px;" type="submit" class="btn btn-danger" >
            <a id='back_to_reviews' href="{{route('course.reviews.index',['course'=>$course])}}">Back To Reviews</a></button>
    </div>
@endsection('content')
