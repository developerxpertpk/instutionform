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
        <td> School Address </td>
        <td> City </td>
        <td> State </td>
        <td> Country </td>
        <td> Action </td>

    </tr>
        @if(isset($schools_name))
        @foreach($schools_name as $data )
            <tr>
                <td>{{ ++$i }} </td>
                <td>{{ $data->school_name }}</td>
                <td>{{ $data->school_address }}</td>
                <td>{{ $data->locations->city }}</td>
                <td>{{ $data->locations->state }} </td>
                <td>{{ $data->locations->country }} </td>
                <td>

                <a href="{{ route('rating_reviews.show',$data->id) }}" class="btn btn-success" >Show List </a> </td>

                </td>
            @endforeach
            @endif
    </table>
    </div>
</div>
</div>
</div>
@endsection