
<?php use App\Constants\UserTypes; ?>
{{--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">--}}
{{--<link href="{{ asset('css/users.css') }}" rel="stylesheet">--}}
{{--<h2>Form 1</h2>--}}
{{--<div class="container">--}}
{{--<div class="row">--}}
{{--<div class="col-lg-12">--}}
{{--<div class="main-box clearfix">--}}
{{--<div class="table-responsive">--}}
{{--<table class="table user-list">--}}
{{--<thead>--}}
{{--<tr>--}}
{{--<th><span>Name</span></th>--}}
{{--<th><span>Professor</span></th>--}}
{{--<th class="text-center"><span>Start Date</span></th>--}}
{{--<th class="text-center"><span>End Date</span></th>--}}
{{--<th><span>Reviews(Average Rate)</span></th>--}}
{{--</tr>--}}
{{--</thead>--}}
{{--<tbody>--}}
{{--<tr>--}}
{{--<td>--}}
{{--<div >--}}
{{--{{$course->name}}--}}
{{--({{$course->start_date < \Carbon\Carbon::today() ? "Active" : "Not Active"}})--}}
{{--</div>--}}
{{--</td>--}}
{{--<td>--}}
{{--<div>--}}
{{--{{$course->professor ? $course->professor->name : '' }}--}}
{{--</div>--}}
{{--</td>--}}

{{--<td class="text-center">--}}
{{--{{$course->start_date}}--}}
{{--</td>--}}
{{--<td class="text-center">--}}
{{--{{$course->end_date}}--}}
{{--</td>--}}
{{--<td class="text-center">--}}
{{--Reviews ({{$course->reviews->count() >= 1 ? $course->calculateAverageCourseRate() : 'No Reviews'}})--}}
{{--</td>--}}

{{--</tr>--}}

{{--</tbody>--}}
{{--</table>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="container">--}}
{{--<div class="row">--}}
{{--<div class="col-lg-12">--}}
{{--<div class="main-box clearfix">--}}
{{--<div class="table-responsive">--}}
{{--<table class="table user-list">--}}
{{--<thead>--}}
{{--<tr>--}}
{{--<th><span>Student ID</span></th>--}}
{{--<th><span>Student Name</span></th>--}}
{{--<th><span>Gender</span></th>--}}
{{--<th><span>Date Of Birth</span></th>--}}
{{--<th><span>Email</span></th>--}}
{{--<th>&nbsp;</th>--}}
{{--</tr>--}}
{{--</thead>--}}
{{--<tbody>--}}

{{--@foreach($users as $user)--}}
{{--@if(UserTypes::getOne($user->type)=="Student")--}}
{{--<tr>--}}
{{--<td>--}}
{{--<h2>{{$user->id}}</h2>--}}
{{--</td>--}}
{{--<td>--}}
{{--<img src="https://e7.pngegg.com/pngimages/743/752/png-clipart-computer-icons-personally-identifiable-information-icon-design-symbol-a-new-user-miscellaneous-cdr.png" alt="">--}}
{{--<div class="container">--}}
{{--<h4>{{$user->name}}</h4>--}}
{{--<h6>{{UserTypes::getOne($user->type)}}</h6>--}}
{{--</div>--}}
{{--</td>--}}
{{--<td class="text-center">--}}
{{--<h5>{{$user->gender == 1 ? "Male" : "Female"}}</h5>--}}
{{--</td>--}}
{{--<td class="text-center">--}}
{{--<h5>{{$user->date_of_birth}}</h5>--}}
{{--</td>--}}
{{--<td class="text-center">--}}
{{--<h5>{{$user->email}}</h5>--}}
{{--</td>--}}
{{--</tr>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</tbody>--}}
{{--</table>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /*@font-face {*/
        /*font-family: SourceSansPro;*/
        /*src: url(SourceSansPro-Regular.ttf);*/
        /*}*/

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #0087C3;
            text-decoration: none;
        }

        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-family: SourceSansPro;
        }

        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
        }

        #logo {
            float: left;
            margin-top: 8px;
        }

        #logo img {
            height: 70px;
        }

        #company {
            float: right;
            text-align: right;
        }


        #details {
            margin-bottom: 50px;
        }

        #client {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
            float: left;
        }

        #client .to {
            color: #777777;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
        }

        #invoice h1 {
            color: #0087C3;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0  0 10px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 20px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            text-align: right;
        }

        table td h3{
            color: #57B223;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
        }

        table .no {
            color: #FFFFFF;
            font-size: 1.6em;
            background: #57B223;
        }

        table .desc {
            text-align: left;
        }

        table .unit {
            background: #DDDDDD;
        }

        table .qty {
        }

        table .total {
            background: #57B223;
            color: #FFFFFF;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table tbody tr:last-child td {
            border: none;
        }

        table tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr:last-child td {
            color: #57B223;
            font-size: 1.4em;
            border-top: 1px solid #57B223;

        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks{
            font-size: 2em;
            margin-bottom: 50px;
        }

        #notices{
            padding-left: 6px;
            border-left: 6px solid #0087C3;
        }

        #notices .notice {
            font-size: 1.2em;
        }

        footer {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;
            text-align: center;
        }

        .grus{
            color:yellow;
            font-size: 100px;
        }

    </style>
    <meta charset="utf-8">
    <title>({{$course->name}}) Course Data</title>
    {{--<link rel="stylesheet" href="style.css" media="all" />--}}
</head>
<body>
<h2>Form 2</h2>

<header class="clearfix">

</header>

<main>

    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="no">Name</th>
            <th class="no">Professor</th>
            <th class="no">Start Date </th>
            <th class="no">End Date</th>
            <th class="no">Reviews(Average Rate)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="desc">{{$course->name}}
                ({{$course->start_date < \Carbon\Carbon::today() ? "Active" : "Not Active"}})
            </td>
            <td class="desc"><h3>{{$course->professor ? $course->professor->name : '' }}</h3></td>
            <td class="desc">{{$course->start_date}}</td>
            <td class="qty">{{$course->end_date}}</td>
            <td class="desc">Reviews ({{$course->reviews->count() >= 1 ? $course->calculateAverageCourseRate() : 'No Reviews'}})</td>
        </tr>
        </tbody>
        {{--<tfoot>--}}
        {{--<tr>--}}
        {{--<td colspan="2"></td>--}}
        {{--<td colspan="2">SUBTOTAL</td>--}}
        {{--<td>$5,200.00</td>--}}
        {{--</tr>--}}
        {{--</tfoot>--}}
    </table>

    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="no">Student ID</th>
            <th class="no">Student Name</th>
            <th class="no">Gender </th>
            <th class="no">Date Of Birth</th>
            <th class="no">Email</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            @if(UserTypes::getOne($user->type)=="Student")
                <tr>
                    <td class="unit">{{$user->id}}</td>
                    <td class="desc">
                        <h4>{{$user->name}}</h4>
                        <h6>{{UserTypes::getOne($user->type)}}</h6>
                    </td>
                    <td class="desc"><h5>{{$user->gender == 1 ? "Male" : "Female"}}</h5></td>
                    <td class="qty"><h5>{{$user->date_of_birth}}</h5></td>
                    <td class="desc"><h5>{{$user->email}}</h5></td>
                </tr>
            @endif
        @endforeach
        </tbody>
        {{--<tfoot>--}}
        {{--<tr>--}}
        {{--<td colspan="2"></td>--}}
        {{--<td colspan="2">SUBTOTAL</td>--}}
        {{--<td>$5,200.00</td>--}}
        {{--</tr>--}}
        {{--</tfoot>--}}
    </table>
</main>

</body>
</html>
