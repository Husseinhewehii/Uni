@extends('layouts.app')

@section('content')
    <h1>Permissions</h1>
<div class="app-content">
    <section class="section">

        <!--page-header open-->
        <div class="page-header">
            <h4 class="page-title">{{ trans('permissions') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-light-color">{{ trans('home') }}</a></li>
                <li class="breadcrumb-item status" aria-current="page">{{ trans('permissions') }}</li>
            </ol>
        </div>
        <!--page-header closed-->
        <!--row open-->
        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Filters</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" type="get" action="#">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <input type="text" placeholder="{{ trans('name') }}" class="form-control" value="{{ request("name") }}" name="name" >
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-1 mb-0">{{ trans("search") }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--row closed-->

        <div class="section-body">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
<!--                            <span class="table-add float-right">
                                <a href="#" class="btn btn-icon"><i class="fa fa-plus fa-1x" aria-hidden="true"></i></a>
                            </span>-->
                            <h4>{{ trans('permissions_list') }}</h4>
                        </div>

                        <div class="card-body">
                            @if(session()->has('success'))
                            <div class="alert alert-success alert-has-icon alert-dismissible show fade">
                                <div class="alert-icon"><i class="ion ion-ios-lightbulb-outline"></i></div>
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>×</span>
                                    </button>
                                    <div class="alert-title">{{ trans('success') }}</div>
                                    {{ session('success') }}
                                </div>
                            </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0 text-nowrap">
                                    <thead>

                                        <tr>
                                            <th style="width: 1px">#</th>
                                            <th>{{ trans('name') }}</th>
                                            <th style="width: 1px">{{ trans('status') }}</th>
                                            <th style="width: 1px">{{ trans('actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td><span class="badge badge-{{ $item->status ? 'success' : 'danger' }}">{{ $item->status? trans('Enabled') : trans('disabled') }}</span></td>
                                            <td>
                                                <div class="btn-group dropdown">
                                                    <button type="button" class="btn btn-sm btn-info m-b-5 m-t-5 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa-cog fa"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item has-icon" href="#"><i class="fa fa-edit"></i> {{ trans('edit') }}</a>

                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $list->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@stop
