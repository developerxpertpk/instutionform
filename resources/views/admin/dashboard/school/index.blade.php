@extends ('layouts.admin.adminLayout')
@section('content')

<div id="page-wrapper">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
				Manage Schools & Institutes
				</h1>
				<!-- <ol class="breadcrumb">
					<li>
						<i class="fa fa-dashboard"></i>Dashboard
					</li>
					<li >
						<i class="fa fa-anchor"></i> School
					</li>

					<li class="active">
						<i class="fa fa-anchor"></i> list
					</li>
				
				</ol> -->
			</div>
		</div>
		<!-- /.row -->
	 <a href="{{ route('school.create')}}"> <button class="btn btn-primery"> Add School 
      </button></a>

	<div class="pull-right">
		
	<div class="search-bar">
	
		<form method="GET" action ="#" >
		  <input type="text" id="search-bar" placeholder ="search" >
		</form>
		</div>
    </div>



 <!-- end of model0 (add model) -->

 <!-- container to show detail of schools -->
 <div class="container">


  @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{  $message }}</p>
        </div>
    @endif

<div class="list-school">
    <table class="table table-bordered">
        <tr><h1>
            <th>ID</th>
            <th>NAME </th>
            <th>ADDRESS </th>
            <th>CITY </th>
            <th>STATE</th>
            <th>COUNTRY</th>
            <th>STATUS</th>
            <th width="320px">Action</th></h1>
        </tr>

    @foreach ($schools as $key => $school)
    		<tr>
		        <td>{{ ++$i }}</td>
		        <td>{{ $school->school_name }}</td>
		        <td>{{ $school->school_address }}</td>
		        <td>{{ $school->locations->city }} </td>
		        <td>{{ $school->locations->state}} </td>
		        <td>{{ $school->locations->country}} </td>	   
            	<td>{{ $school->status }}</td>
		        <td> 
		        <button type="button" class="btn btn-success" >Show</button>
		        <button type="button" class="btn btn-success">block</button>

            <a class="btn btn-primary" href="{{ route('school.edit',$school->id)}}">  Edit  </a>

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
             <h3> Do you want to delete {{$school->id}} ? </h3>
            </div>

            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                  {!! Form::open(['method' => 'DELETE','route' => ['school.destroy', $school->id],'style'=>'display:inline','class'=>'delete']) !!}

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
 </div>


@endsection