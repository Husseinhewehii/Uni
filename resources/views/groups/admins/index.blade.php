@extends('layouts.app')
<?php use App\Constants\UserTypes; ?>
@section('content')
    <h1>Group"{{$group->name}}" Admin</h1>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/users.css') }}" rel="stylesheet">
    <div class="container">
        <a class="btn btn-success" style="margin: 12px auto;" href="{{route('group.users.create',['group'=>$group])}}"> Add Admin</a>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                            <tr>
                                <th><span>ID</span></th>
                                <th><span>Admin</span></th>
                                <th><span>Created</span></th>

                                <th class="text-center"><span>Gender</span></th>
                                <th class="text-center"><span>Date Of Birth</span></th>
                                <th><span>Email</span></th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                @if($admin->type == 1)
                                <tr>
                                    <td>
                                        {{$admin->id}}
                                    </td>
                                    <td>
                                        <img src="https://e7.pngegg.com/pngimages/743/752/png-clipart-computer-icons-personally-identifiable-information-icon-design-symbol-a-new-user-miscellaneous-cdr.png" alt="">

                                        <a href="#" class="user-link">{{$admin->name}}</a>
                                        {{UserTypes::getOne($admin->type)}}
                                    </td>
                                    <td>
                                        {{$admin->created_at->format('d/m/Y')}}
                                    </td>

                                    <td class="text-center">

                                        {{$admin->gender == 1 ? "Male" : "Female"}}
                                    </td>
                                    <td class="text-center">
                                        {{$admin->date_of_birth ? $admin->date_of_birth : "-"}}
                                    </td>
                                    <td>
                                        {{$admin->email}}
                                    </td>
                                    <td style="width: 10%;">


                                        <a class="table-link danger" data-toggle="modal" data-target="#removeUser{{ $admin->id }}">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                </span>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--{{$admins->links()}}--}}
                </div>
            </div>
        </div>
    </div>
    @foreach ($admins as $admin)
        <div class="modal fade" id="removeUser{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{trans('Warning')}}</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('group.users.destroy', ['group'=>$group,'user' => $admin]) }}" method="Post">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <p class="mb-0">{{trans('Remove Admin From Group?')}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">{{trans('Cancel')}}</button>
                            <button type="submit" class="btn btn-danger"> {{trans('Remove')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
