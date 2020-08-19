@extends('layouts.app')
@section('content')
    <h1 class="">User's Courses, Welcome {{$user->name}}</h1>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/users.css') }}" rel="stylesheet">
    <div class="container">
        <a class="btn btn-success" style="margin: 12px auto;" href="{{route('users.courses.create',['user'=>$user])}}"> Add Course</a>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                            <tr>
                                <th><span>User</span></th>
                                <th><span>Course</span></th>

                                <th class="text-center"><span>Start Date</span></th>
                                <th class="text-center"><span>End Date</span></th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>
                                        <img src="https://e7.pngegg.com/pngimages/743/752/png-clipart-computer-icons-personally-identifiable-information-icon-design-symbol-a-new-user-miscellaneous-cdr.png" alt="">
                                        <h4>{{$user->name}}</h4>
                                        <h6>{{$user->type == 1 ? "Admin" : "User"}}</h6>
                                    </td>
                                    <td>
                                        <h4>{{$course->name}}</h4>
                                    </td>

                                    <td class="text-center">
                                        <h5>{{$course->start_date}}</h5>
                                    </td>
                                    <td class="text-center">
                                        <h5>{{$course->end_date}}</h5>
                                    </td>
                                    <td style="width: 10%;">
                                        <a class="table-link danger" data-toggle="modal" data-target="#removeUser{{ $course->id }}">
                                            <span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--{{$courses->links()}}--}}
                </div>
            </div>
        </div>
    </div>
    @foreach ($courses as $course)
        <div class="modal fade" id="removeUser{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{trans('delete')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('users.courses.destroy', ['user'=> $user,'course' => $course]) }}" method="Post">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <p class="mb-0">{{trans('Delete?')}}</p>
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
