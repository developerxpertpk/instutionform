@extends('layouts.admin.adminLayout')
@section('content')

   <div id="page-wrapper">
			<div class="container-fluid">
                <!-- Page Heading -->
			
                <div class="row">
                    <div class="col-lg-12">
					
                        <h2 class="page-header">
                            Content Manager	
                        </h2>
						
					<div class="pull-right">
					
						<a class="btn btn-success" href="{{ route('addpages')}}"> ADD PAGE  </a>
						<a class="btn btn-danger" href="#"> BACK  </a>
					</div>
							
                    </div>
                </div>
				
				
			<div class="row"> 
					<h2>pages</h2>
					
			</div>
		
		
	</div>
	</div> 
		
@endsection