@extends('layouts.admin.adminLayout')

@section('content')

	<div class="col-lg-12">
	<div class="pull-left">
                <h3>  No Result Found </h3>
     </div>	

     <div class="pull-right">
              <a href="{{ route('user.index') }}">  back </a>
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
@endsection