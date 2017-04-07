@extends('layouts.admin.adminLayout')

@section('content')
    <div class="page-wraper">
        <div class="conatiner-fluid">
                <div class="col-lg-12">

                        <h3 class="page-header"> Error Page </h3>

                     <div class="pull-right">
                         <a  href="{{ route('admin.dashboard') }}"> <button class="btn btn-primery"> back  </button></a>
                     </div>

                    <div class="row ">
                        <h4> 404 Error data not found</h4>
                    </div>
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