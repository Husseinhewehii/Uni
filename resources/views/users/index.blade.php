@extends('layouts.app')

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
                                <th><span>User</span></th>
                                <th><span>Created</span></th>

                                <th class="text-center"><span>Gender</span></th>
                                <th class="text-center"><span>Date Of Birth</span></th>
                                <th><span>Email</span></th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <img src="https://e7.pngegg.com/pngimages/743/752/png-clipart-computer-icons-personally-identifiable-information-icon-design-symbol-a-new-user-miscellaneous-cdr.png" alt="">

                                        <a href="{{route('users.courses.index',['user'=>$user])}}" class="user-link">{{$user->name}}</a>
                                        {{$user->type == 1 ? "Admin" : "User"}}
                                    </td>
                                    <td>
                                        {{$user->created_at->format('d/m/Y')}}
                                    </td>

                                    <td class="text-center">

                                        {{$user->gender == 1 ? "Male" : "Female"}}
                                    </td>
                                    <td class="text-center">
                                       {{$user->date_of_birth ? $user->date_of_birth : "-"}}
                                    </td>
                                    <td>
                                         {{$user->email}}
                                    </td>
                                    <td style="width: 10%;">
                                        <a href="{{ route('users.edit', ['user' => $user]) }}" class="table-link">
                                            <span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-pencil $user->date_of_birthfa-stack-2x fa-inverse"></i>
                                            </span>
                                        </a>

                                        <a class="table-link danger" data-toggle="modal" data-target="#removeUser{{ $user->id }}">
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
                   {{$users->links()}}
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
                    <form action="{{ route('users.destroy', ['user' => $user]) }}" method="Post">
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
