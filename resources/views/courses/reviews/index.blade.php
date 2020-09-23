@extends('layouts.app')
@section('content')
    <h1>{{$course->name}} course reviews</h1>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/users.css') }}" rel="stylesheet">
    <div class="container">
        @can('create', [\App\Models\Review::class, $course])
            <a class="btn btn-primary" style="margin: 12px auto;" href="{{route('course.reviews.create',['course'=>$course])}}"> Add Review</a>
        @endcan

            <div class="container" >
                @if(session()->has('success'))
                    <div class="card" id='review_added_successfully' >
                        {{session('success')}}
                    </div>
                @elseif(session()->has('danger'))
                    <div class="card" id='review_deleted_successfully' >
                        {{session('danger')}}
                    </div>
                @endif
            </div>

            <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                            <tr>
                                <th><span>Reviewer</span></th>
                                <th><span>Rate</span></th>
                                <th><span>Comment</span></th>
                                <th class="text-center"><span>Created At</span></th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>
                                        <div >
                                            @if(\App\Models\User::find($review->user_id))
                                                <a href="#" class="user-link">{{\App\Models\User::find($review->user_id)->name}}</a>
                                            @else
                                                User
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        {{$review->rate}}
                                    </td>

                                    <td class="text-center">
                                        {{$review->comment}}
                                    </td>
                                    <td class="text-center">
                                        {{$review->created_at}}
                                    </td>
                                    <td class="text-center">
                                        {{--{{$course->students}}--}}
                                    </td>
                                    <td style="width: 10%;">
                                        @can('update', [\App\Models\Review::class, $course, $review])
                                            <a href="{{route('course.reviews.edit',['course'=>$course,'review'=>$review])}}" class="table-link">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-pencil $course->date_of_birthfa-stack-2x fa-inverse"></i>
                                                </span>
                                            </a>
                                        @endcan


                                        @can('delete', [\App\Models\Review::class, $course, $review])
                                            <a class="table-link danger" data-toggle="modal" data-target="#removeUser{{ $review->id }}">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--{{$reviews->links()}}--}}
                </div>
            </div>
        </div>
    </div>
    @foreach ($reviews as $review)
        <div class="modal fade" id="removeUser{{ $review->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{trans('delete')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('course.reviews.destroy', ['course'=>$course,'review' => $review]) }}" method="Post">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <p class="mb-0">{{trans('Delete?')}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">{{trans('Cancel')}}</button>
                            <button type="submit" class="btn btn-danger">{{trans('Delete')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach



@endsection

@section("scripts")

    <script>

        function reviewPop(message){
            alert(message);
        }
        @php if(session()->has('success')) { @endphp
            var msg = @php session('success') @endphp ;
        reviewPop( msg );
        @php  } @endphp
    </script>
@stop
