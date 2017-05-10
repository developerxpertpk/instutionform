@extends('layouts.admin.adminLayout')
@section('content')
   <div id="page-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-lg-12">
						<h3 class="page-header">
							Static  Pages
						</h3>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
							<li class="breadcrumb-item active">Static Content </li>
						</ol>
					</div>
				</div>
		<!-- Page Heading -->
	<a class="btn btn-primary" href="{{ route('addpages')}}">Add Pages </a>

	@if (count($errors))
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
			@foreach ($errors->all() as $error)
				  <li>{{ $error }}</li>
					<?php echo $errors ;?>
				@endforeach
			</ul>
		</div>
	@endif

	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{  $message }}</p>
		</div>
	@endif

	<div class="Pages">
					<table class="table table-bordered">
						<tr>
							<h4>Pages </h4>
						</tr>

						<tr>
							<th>ID</th>
							<th>Content Type</th>
							<th>Title</th>
							<th>Slug</th>
							<th>Content </th>
							<th width="320px">Action</th>
						</tr>
						@foreach ($page as $pages)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $pages->content_type }}</td>
								<td>{!!  str_limit($pages->title ,100,'...') !!}  </td>
								<td>{{ $pages->slug }}</td>
								<td>{!!  str_limit($pages->content,100,'...') !!}</td>
								<td>
				{{-- Button {{ route('content.show',$pages->id) }}for show--}}
				<a href="/{{$pages->slug}}" target="_blank" type="button" class="btn btn-success">
					Show
				</a>
				{{-- Button for edit--}}
				<a href="{{ route('content.edit',$pages->id) }}" type="button" class="btn btn-primary">
					Edit
				</a>
				<!-- Button for  Delete-->
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal01">
					Delete
				</button>

				<!-- Modal  for delete with id=01-->
				<div class="modal fade" id="myModal01" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">

							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Confirmation  </h4>
							</div>

							<div class="modal-body">
								<h3> Do you want to delete {{$pages->title}}  ? . </h3>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
								{!! Form::open(['method' => 'DELETE','route' => ['content.destroy',$pages->id ],'style'=>'display:inline','class'=>'delete']) !!}

								{!! Form::submit('delete', ['class' => 'btn btn-success']) !!}
								{!! Form::close() !!}
							</div>
						</div>
					</div>
				</div>

			</td>
		</tr>
	@endforeach
	</table>
	</div>

</div>
@endsection