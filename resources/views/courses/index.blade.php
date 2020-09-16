@extends('layouts.app')
<?php use App\Constants\PDFFormTypes; ?>
@section('content')
    <h1>courses</h1>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/users.css') }}" rel="stylesheet">
    <div class="container">
        <a class="btn btn-success table-link" style="margin: 10px;" href="{{route('courses.export.excel')}}">Export Courses</a>
        <br>
        {{--<a class="btn btn-success table-link" style="margin: 10px;" href="{{route('insert_many_courses')}}">Insert Courses</a>--}}
        <a class="btn btn-success table-link" style="margin: 10px;" href="{{route('courses.insert.twenties')}}">Insert Courses</a>

        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                            <tr>
                                <th><span>Name</span></th>
                                <th><span>Professor</span></th>
                                <th class="text-center"><span>Start Date</span></th>
                                <th class="text-center"><span>End Date</span></th>
                                <th><span>Reviews(Average Rate)</span></th>
                                @can('update',\App\Models\Course::class)
                                    <th>&nbsp;</th>
                                @endcan

                                @can('delete',\App\Models\Course::class)
                                    <th>&nbsp;</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>
                                        <div >
                                            <a href="{{ route('courses.users.index',['course'=>$course]) }}" class="user-link">{{$course->name}}</a>
                                            {{$course->start_date < \Carbon\Carbon::today() ? "Active" : "Not Active"}}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ $course->professor ? route('users.courses.index.professor',['user'=>$course->professor]) : '#'}}" class="user-link">{{$course->professor ? $course->professor->name : '' }}</a>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        {{$course->start_date}}
                                    </td>
                                    <td class="text-center">
                                        {{$course->end_date}}
                                    </td>
                                    <td class="text-center">
                                        {{--@php $x=0; @endphp--}}
                                        {{--@foreach($course->reviews as $review)--}}
                                            {{--@php $x+=$review->rate @endphp--}}
                                        {{--@endforeach--}}
                                        {{--<a href="{{ route('course.reviews.index',['course'=>$course]) }}" class="user-link">Reviews({{$course->reviews->count() >=1 ? $x/$course->reviews->count() : 'No Reviews'}})</a>--}}
                                        <a href="{{ route('course.reviews.index',['course'=>$course]) }}" class="user-link">Reviews ({{$course->reviews->count() >= 1 ? $course->calculateAverageCourseRate() : 'No Reviews'}})</a>
                                    </td>
                                    {{--@if(auth()->user()->hasAccess("courses.update") || auth()->user()->hasAccess("courses.destroy"))--}}
                                        <td style="width: 10%;">
                                            @can('update',\App\Models\Course::class)
                                                <a href="{{ route('courses.edit', ['course'=>$course]) }}" class="table-link">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-pencil $course->date_of_birthfa-stack-2x fa-inverse"></i>
                                                    </span>
                                                </a>
                                            @endcan

                                            @can('delete',\App\Models\Course::class)
                                                <a class="table-link danger" data-toggle="modal" data-target="#removeUser{{ $course->id }}">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                            @endcan
                                                <a data-target="#chooseForm{{ $course->id }}" class="btn btn-success table-link" style="margin: 10px;" data-toggle="modal">Export Course</a>
                                        </td>
                                    {{--@endif--}}

                                </tr>
                                <div class="modal fade" id="chooseForm{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Choose Form</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div>
                                                <ul>
                                                    @foreach(PDFFormTypes::getList() as $key => $value)
                                                        <a class="btn btn-success table-link" style="margin: 10px;" href="{{route('course.export.pdf',['course'=>$course,'form_number'=>$value])}}">Form {{$key}}</a>
                                                    @endforeach
                                               </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$courses->links()}}
                </div>
            </div>
        </div>
    </div>

    @foreach ($courses as $course)
        <div class="modal fade" id="removeUser{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{trans('delete')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('courses.destroy', ['course' => $course]) }}" method="Post">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <p class="mb-0">{{trans('Delete?')}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">{{trans('Cancel')}}</button>
                            <button type="submit" class="btn btn-danger">{{trans('Delete')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
