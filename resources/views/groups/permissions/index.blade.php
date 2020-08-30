@extends('layouts.app')
<?php use App\Constants\UserTypes; ?>
@section('content')
    <h1>Group ({{$group->name}}) permissions</h1>
    <?php
    $lang = app()->getLocale();
    ?>

    <div class="app-content">
        <section class="section">

            <!--page-header open-->
            <div class="page-header">
                <h4 class="page-title">{{trans('manage_permissions')}}</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-light-color">{{trans('home')}}</a></li>
                    <li class="breadcrumb-item"><a href="#" class="text-light-color">{{trans('groups')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('manage_permissions')}}</li>
                </ol>
            </div>
            <!--page-header closed-->
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{trans('manage_permissions')}}</h4>
                            </div>
                            <div class="card-body">

                                @if(session()->has('success'))
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
                                @endif

                                {{--@include('admin.errors')--}}
                                <form action="{{route('group.permissions.store',['group'=>$group])}}" method="Post" autocomplete="off" >
                                    @method('POST')
                                    @csrf
                                    <label>
                                        <input type="checkbox" name="select-all" id="select-all" />
                                        {{ trans('check_all') }}
                                    </label>

                                    <div class="form-group col-md-12 row">
                                        @foreach ($permissions as $permission)
                                            <div class="form-group mb-0 col-md-4">

                                                <label>
                                                    <input type="checkbox" name="permissions[]"  value="{{$permission->id}}"  {{ ($group->permissions->contains('id', $permission->id)) ? 'checked' : '' }} >
                                                    {{--{{$permission->translate($lang)->name}}--}}
                                                    {{$permission->name}}
                                                </label>

                                            </div>
                                        @endforeach

                                    </div>

                                    <div class="form-group col-md-12 row">
                                        <div class="form-group col-md-3">
                                            <button type="submit" href="#" class="btn  btn-outline-primary m-b-5  m-t-5">
                                                <i class="fa fa-save"></i> {{trans('save')}}</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
@section('scripts')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>

        // $('#select-all').onclick( function() {
        //
        //     if(this.checked) {
        //
        //         // Iterate each checkbox
        //         $(':checkbox').each(function() {
        //             this.checked = true;
        //         });
        //     } else {
        //         $(':checkbox').each(function() {
        //             this.checked = false;
        //         });
        //     }
        // });

        $(document).ready(function(){
            $("#select-all").click(function(){
                if(this.checked) {

                    // Iterate each checkbox
                    $(':checkbox').each(function() {
                        this.checked = true;
                    });
                } else {
                    $(':checkbox').each(function() {
                        this.checked = false;
                    });
                }
            });
        });
    </script>
@stop
