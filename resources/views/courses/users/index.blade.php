@extends('layouts.app')
<?php use App\Constants\UserTypes; ?>
@section('content')
    <div class="card text-center">
        <div class="card-header">
            <h2 class="h2o">{{$course->name}}</h2>
            <h3>Professor: {{\App\Models\User::find($course->professor_id) ? \App\Models\User::find($course->professor_id)['name'] : 'Professor'}}</h3>
        </div>
    </div>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/users.css') }}" rel="stylesheet">
    <div class="container">
        <a class="btn btn-success table-link" style="margin: 10px;" href="{{route('course.users.export.excel',['course'=>$course])}}">Export Course</a>
        <a class="btn btn-success" style="margin: 12px auto;" href="{{route('courses.users.create',['course'=>$course])}}"> Add Student</a>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                            <tr>
                                <th><span>Student ID</span></th>
                                <th><span>Student Name</span></th>
                                <th><span>Gender</span></th>
                                <th><span>Date Of Birth</span></th>
                                <th><span>Email</span></th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>

                                @if($users->count() > 0)
                                    @foreach($users as $user)
                                        @if(UserTypes::getOne($user->type)=="Student")
                                            <tr>
                                                <td>
                                                    <h2>{{$user->id}}</h2>
                                                </td>
                                                <td>
                                                    <img src="https://e7.pngegg.com/pngimages/743/752/png-clipart-computer-icons-personally-identifiable-information-icon-design-symbol-a-new-user-miscellaneous-cdr.png" alt="">
                                                    <div class="container">
                                                        <h4><a href="{{route('users.courses.index.student',['user'=>$user])}}">{{$user->name}}</a></h4>
                                                        <h6>{{UserTypes::getOne($user->type)}}</h6>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <h5>{{$user->gender == 1 ? "Male" : "Female"}}</h5>
                                                </td>
                                                <td class="text-center">
                                                    <h5>{{$user->date_of_birth}}</h5>
                                                </td>
                                                <td class="text-center">
                                                    <h5>{{$user->email}}</h5>
                                                </td>
                                                <td style="width: 10%;">
                                                    <a class="table-link danger" data-toggle="modal" data-target="#removeUser{{ $user->id }}">
                                                <span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                 </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{--{{$courses->links()}}--}}
                </div>
            </div>
        </div>
    </div>
    @foreach ($users as $user)
        <div class="modal fade" id="removeUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{trans('delete')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('courses.users.destroy', ['course' => $course,'user'=> $user]) }}" method="Post">
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




