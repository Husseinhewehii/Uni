{{--@extends('layouts.app')--}}
{{--<?php use App\Constants\UserTypes; ?>--}}
{{--@section('content')--}}
    {{--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">--}}
    {{--<link href="{{ asset('css/users.css') }}" rel="stylesheet">--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-lg-12">--}}
                {{--<div class="main-box clearfix">--}}
                    {{--<div class="table-responsive">--}}
                        {{--<table class="table user-list">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th><span>ID</span></th>--}}
                                {{--<th><span>Student</span></th>--}}
                                {{--<th><span>Created</span></th>--}}

                                {{--<th class="text-center"><span>Gender</span></th>--}}
                                {{--<th class="text-center"><span>Date Of Birth</span></th>--}}
                                {{--<th><span>Email</span></th>--}}
                                {{--<th><span>Gallery</span></th>--}}
                                {{--<th>&nbsp;</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--@foreach($users as $user)--}}
                                {{--@if($user->type == 1)--}}
                                {{--<tr>--}}
                                    {{--<td>--}}
                                        {{--{{$user->id}}--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--@if($user->image)--}}
                                            {{--<img src="{{asset($user->image)  }}" alt="not uploaded" style="width:120px; height: 80px;">--}}
                                        {{--@else--}}
                                            {{--<img src="https://e7.pngegg.com/pngimages/743/752/png-clipart-computer-icons-personally-identifiable-information-icon-design-symbol-a-new-user-miscellaneous-cdr.png" alt="">--}}
                                        {{--@endif--}}

                                        {{--<a href="#" class="user-link">{{$user->name}}</a>--}}
                                        {{--{{UserTypes::getOne($user->type)}}--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--{{$user->created_at->format('d/m/Y')}}--}}
                                    {{--</td>--}}

                                    {{--<td class="text-center">--}}

                                        {{--{{$user->gender == 1 ? "Male" : "Female"}}--}}
                                    {{--</td>--}}
                                    {{--<td class="text-center">--}}
                                        {{--{{$user->date_of_birth ? $user->date_of_birth : "-"}}--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--{{$user->email}}--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<a href="{{route('user.gallery.index',['user'=>$user])}}">Gallery</a>--}}
                                    {{--</td>--}}
                                    {{--<td style="width: 10%;">--}}
                                        {{--<li class="nav-link"><button @click.prevent="postNotification">Send Notification</button></li>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                    {{--{{$users->links()}}--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

{{--@endsection--}}
{{--<script>--}}
    {{--const app = new Vue({--}}
        {{--el: '#app',--}}
        {{--data: {--}}
            {{--notifications: {},--}}
            {{--user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!}--}}
        {{--},--}}
        {{--mounted(){--}}
            {{--this.getNotifications();--}}
        {{--},--}}
        {{--methods:{--}}
            {{--getNotifications(){--}}
                {{--axios.get('/api/users/'+this.user.id+'/notifications')--}}
                    {{--.then((response) => {--}}
                        {{--this.notifications = response.data--}}
                    {{--})--}}
                    {{--.catch(function(error){--}}
                        {{--console.log(error);--}}
                    {{--});--}}
            {{--},--}}
            {{--postNotification(){--}}
                {{--axios.get('api/send-notification/'+this.user.id)--}}
                    {{--.then((response) => {--}}
                        {{--console.log(response.data);--}}
                        {{--this.notifications.unshift(response.data)--}}
                    {{--})--}}
                    {{--.catch(function (error) {--}}
                        {{--console.log(error);--}}
                    {{--});--}}
            {{--},--}}
            {{--listen(){--}}
                {{--Echo.channel('navigation')--}}
                    {{--.listen('BenachrichtigungEvent', (notification) => {--}}
                        {{--this.notifications.unshift(notification);--}}
                    {{--});--}}
            {{--}--}}
        {{--}--}}
    {{--});--}}
{{--</script>--}}
