@extends('layouts.app')

@section('content')
    <h1>{{$user->name}}'s Gallery</h1>

    <div class="container">
        <h2>Add an Image</h2>
        <form action="{{ route('user.gallery.store',['user'=>$user]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="">
                <div class="form-group col-md-6">
                    <label for="">Upload Image</label>
                    <input onchange="file_selected = true;"  type="file" placeholder="Upload Image" name="image" id='image' class="form-control" >
                </div>
            </div>
            <div class="form-group col-md-6" style="display: none;" id="caption">
                <label for="textAreaType">Caption:</label>
                <textarea  placeholder="Leave Your Caption Here:" name="caption" class="form-control"
                          cols="15" rows="5">{{old('comment')}}</textarea>
            </div>
            <button type="submit" class="btn btn-success" >Create</button>
            <button style="margin:5px;" type="submit" class="btn btn-primary" >
                <a id='back_to_reviews' href="{{route('user.gallery.index',['user'=>$user])}}">Back To Gallery</a></button>
        </form>

    </div>

@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

            $(function() {
                $("#image").change(function (){

                    var caption = document.getElementById('caption');
                    caption.style.display = 'block';

                });
            });
        });



            // var file_selected = false;
            // if(file_selected) { alert('a file selected!'); } // or anything else



            // function checker(){
            //     var file = document.getElementById('image');
            //     if(file.files.length == 0 ){
            //         alert("No files selected");
            //     } else {
            //         alert("a file is selected");
            //     }
            // };


    </script>
@endsection
