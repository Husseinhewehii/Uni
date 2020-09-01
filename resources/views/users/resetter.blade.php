@extends('layouts.app')

@section('content')
    <div class="col-lg-6">
        <div class="usercontent">
            <div class="row">
                <div class="col-12">
                    <h2>نسيت كلمة المرور</h2>
                </div>
                <form action="{{route('users.password.reset')}}"  method="post" class="col-md-8" >
                    {{ csrf_field() }}
                    <div class="row">
                        @if(session()->has('error'))
                            <div class="col-12">
                                <div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                                    <div class="alert-icon"><i class="ion ion-ios-lightbulb-outline"></i></div>
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>×</span>
                                        </button>
                                        <div class="alert-title">{{trans('error')}}</div>
                                        {{ session('error') }}
                                    </div>
                                </div>
                            </div>
                        @elseif(session()->has('success'))
                            <div class="col-12">
                                <div class="alert alert-success alert-has-icon alert-dismissible show fade">
                                    <div class="alert-icon"><i class="ion ion-ios-lightbulb-outline"></i></div>
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>×</span>
                                        </button>
                                        <div class="alert-title">{{trans('success')}}</div>
                                        {{ session('success') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <input   class="btn-block" name="token" type="hidden" value="{{ request('token') }}" />
                        <div class="col-12">
                            <label for="password">@error('email'){{ $message }}@enderror</label>
                            <input class="btn-block" name="email" type="text" placeholder="Email" />
                        </div>
                        <div class="col-12">
                            <label for="password">@error('password'){{ $message }}@enderror</label>
                            <input class="btn-block" name="password" type="password" placeholder="Password" />
                        </div>
                        <div class="col-12">
                            <label for="password_confirmation">@error('password_confirmation'){{ $message }}@enderror</label>
                            <input class="btn-block" name="password_confirmation" type="password" placeholder="Password Confirmation" />
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">تعديل كلمة المرور</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
