@extends('layouts.admin.adminLayout')

@section('content')
    <div class="page-wraper">
        <div class="conatiner-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Error
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <h4> Data Not Found </h4>
            </div>

	  @if ($message = Session::get('success'))
	  	<?php echo "$message"; ?>
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

     </div>
    </div>
@endsection