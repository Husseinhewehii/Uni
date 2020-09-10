@extends('layouts.app')

@section('content')
    <h1>{{$user->name}}'s Gallery</h1>

    <div class="container">

        <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Thumbnail Gallery</h1>
        <h2><a href="{{route('user.gallery.create',['user'=>$user])}}">Add an Image</a></h2>
        @if(session()->has('danger'))
            <div class="card" id='review_deleted_successfully' >
                {{session('danger')}}
            </div>
        @elseif(session()->has('success'))
            <div class="card" id='review_added_successfully' >
                {{session('success')}}
            </div>
        @endif
        <hr class="mt-2 mb-5">
        <div class="row text-center text-lg-left">
            @foreach($gallery as $image)

                <div class="col-lg-3 col-md-4 col-6">
                    <span class="d-block mb-4 h-100">
                        @if($image->image)
                            <div id="container">
                                    <button data-toggle="modal" data-target="#removeUser{{ $image->id }}" id = "x">
                                        X
                                    </button>
                                <img  src="{{asset($image->image)  }}" alt="not uploaded" style="width:120px; height: 80px;">
                                <p>{{$image->caption}}</p>
                            </div>
                        @endif
                    </span>
                </div>
            @endforeach
        </div>
    </div>
    @foreach ($gallery as $gallery)
        <div class="modal fade" id="removeUser{{ $gallery->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{trans('Warning')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('user.gallery.destroy', ['user'=>$user,'gallery' => $gallery]) }}" method="Post">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <p class="mb-0">{{trans('Delete Image?')}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">{{trans('Cancel')}}</button>
                            <button type="submit" class="btn btn-danger"> {{trans('Delete')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
