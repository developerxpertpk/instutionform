@extends('layouts.admin.adminLayout')
@section('content')
<div class="page-wrapper">
<div class="coantiner-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Manage Schools & Institutes Ratings  / Search Result

            </h1>

        </div>
    </div>
    <!--/.row -->

    <div class="pull-right">
        <a href="{{ route('school.index')}}"> <button class="btn btn-primery">Back
            </button></a>
    </div>

    <div class="rating-list">
    <table class="table table-bordered">
    <tr>
        <h3>  List Of Results </h3>
    </tr>
        <tr>
        <td> ID </td>
        <td> School Name </td>
        <td> Ratings </td>
        <td> Reviews </td>
        <td> Action </td>

    </tr>
        @foreach($ratings as $rating )
            @foreach( $schools_name as $school_name)
            <tr>
                <td>{{ ++$i }} </td>
                <td>{{$school_name->school_name}}</td>
                <td>{{$rating->ratings}}</td>
                <td>{{$rating->reviews}}</td>
                <td> edit Delete </td>
            </tr>
                @endforeach
            @endforeach
    </table>
    </div>
</div>
</div>
</div>
@endsection