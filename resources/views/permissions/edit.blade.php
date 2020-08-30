@extends('layouts.app')

@section('content')
<div class="app-content">
    <section class="section">

        <!--page-header open-->
        <div class="page-header">
            <h4 class="page-title">{{ trans('permissions') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-light-color">{{ trans('home') }}</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-light-color">{{ trans('permissions') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ trans('update_permissions') }} #{{ $permission->id }}</li>
            </ol>
        </div>
        <!--page-header closed-->

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ trans('update_permissions') }}</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{route('permissions.update',['permission'=>$permission])}}" method="post" enctype="multipart/form-data" autocomplete="off" >
                                @method('PUT')
                                @csrf
                                <div class="form-group col-md-6">
                                    <label for="">Name</label>
                                    <input type="text"  placeholder="Name" name="name" class="form-control" value="{{$permission->name}}">
                                </div>


                                <div class="form-group col-md-3">
                                    <label class="custom-switch">
                                        <input type="checkbox" name="status" value="1" class="custom-switch-input"  {{old("status",$permission->status) == 1 ? "checked" : "" }} >
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">{{ trans('Enable') }}</span>
                                    </label>
                                </div>

                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn  btn-outline-primary m-b-5  m-t-5"><i class="fa fa-save"></i> {{ trans('save') }}</button>
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
