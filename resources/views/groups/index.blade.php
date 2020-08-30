@extends('layouts.app')
<?php use App\Constants\UserTypes; ?>
@section('content')
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
                                <th><span>Name</span></th>
                                <th><span>Created</span></th>

                                <th class="text-center"><span>Status</span></th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                        <td>
                                            {{$group->id}}
                                        </td>
                                        <td>
                                            <a href="{{route('group.users.index',['group'=>$group])}}" class="user-link">{{$group->name}}</a>
                                        </td>
                                        <td>
                                            {{$group->created_at->format('d/m/Y')}}
                                        </td>

                                        <td class="text-center">
                                            {{$group->status == 1 ? "Activated" : "Deactivated"}}
                                        </td>
                                        <td style="width: 10%;">
                                            <a href="{{ route('groups.edit', ['group' => $group]) }}" class="table-link">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-pencil $user->date_of_birthfa-stack-2x fa-inverse"></i>
                                                    </span>
                                            </a>

                                            <a href="{{ route('group.permissions.index', ['group' => $group]) }}" class="table-link">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="material-icons"></i>
                                                    </span>
                                            </a>

                                            <a class="table-link danger" data-toggle="modal" data-target="#removeUser{{ $group->id }}">
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
                    {{--{{$groups->links()}}--}}
                </div>
            </div>
        </div>
    </div>
    @foreach ($groups as $group)
        <div class="modal fade" id="removeUser{{ $group->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{trans('delete')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('groups.destroy', ['group' => $group]) }}" method="Post">
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
