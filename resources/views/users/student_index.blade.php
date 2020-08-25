@extends('layouts.app')
<?php use App\Constants\UserTypes; ?>
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/users.css') }}" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                            <tr>
                                <th><span>ID</span></th>
                                <th><span>Student</span></th>
                                <th><span>Created</span></th>

                                <th class="text-center"><span>Gender</span></th>
                                <th class="text-center"><span>Date Of Birth</span></th>
                                <th><span>Email</span></th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                {{--@if($student->type == 1)--}}
                                    <tr>
                                        <td>
                                            {{$student->id}}
                                        </td>
                                        <td>
                                            <img src="https://e7.pngegg.com/pngimages/743/752/png-clipart-computer-icons-personally-identifiable-information-icon-design-symbol-a-new-user-miscellaneous-cdr.png" alt="">

                                            <a href="{{route('users.courses.index.student',['user'=>$student])}}" class="user-link">{{$student->name}}</a>
                                            {{UserTypes::getOne($student->type)}}
                                        </td>
                                        <td>
                                            {{$student->created_at->format('d/m/Y')}}
                                        </td>

                                        <td class="text-center">

                                            {{$student->gender == 1 ? "Male" : "Female"}}
                                        </td>
                                        <td class="text-center">
                                           {{$student->date_of_birth ? $student->date_of_birth : "-"}}
                                        </td>
                                        <td>
                                             {{$student->email}}
                                        </td>
                                        <td style="width: 10%;">
                                            <a href="{{ route('users.edit', ['user' => $student]) }}" class="table-link">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-pencil $user->date_of_birthfa-stack-2x fa-inverse"></i>
                                                </span>
                                            </a>

                                            <a class="table-link danger" data-toggle="modal" data-target="#removeUser{{ $student->id }}">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                {{--@endif--}}
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                   {{$students->links()}}
                </div>
            </div>
        </div>
    </div>
    @foreach ($students as $student)
        <div class="modal fade" id="removeUser{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{trans('delete')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('users.destroy', ['user' => $student]) }}" method="Post">
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
