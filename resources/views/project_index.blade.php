<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<script src="{{asset('js/app.js')}}" type="text/javascript" charset="utf-8" async defer></script>
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
	<link rel="stylesheet" href="{{ asset('css/custom_project.css')}}">
</head>
<body>
   <div class="container-fluid">
   		<div class="container">
   			<nav class="navbar navbar-default navigation">
  				<div class="container-fluid">
				    <!-- Brand and toggle get grouped for better mobile display -->
    				<div class="navbar-header">
     					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        					<span class="sr-only">Toggle navigation</span>
        					<span class="icon-bar"></span>
        					<span class="icon-bar"></span>
        					<span class="icon-bar"></span>
      					</button>
      					<a class="navbar-brand" href="#">LOGO</a>
    				</div>

    				<!-- Collect the nav links, forms, and other content for toggling -->
    				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      				<form class="navbar-form navbar-left">
	        				<div class="form-group ">
	        					<div class="input-group">
	        						<div class="input-group-btn">
        									<button type="button" class="btn btn-default dropdown-toggle nav_search" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
        									<ul class="dropdown-menu">
          										<li><a href="#">Action</a></li>
								          		<li><a href="#">Another action</a></li>
								          		<li><a href="#">Something else here</a></li>
								          		<li role="separator" class="divider"></li>
								          		<li><a href="#">Separated link</a></li>
			 						       	</ul>
				      				</div>
	          						<input type="text" class="form-control nav_search" size="35" placeholder="Search">
	          						<span class="input-group-btn">
        								<button type="submit" class="btn btn-default nav_search">Submit</button>
				      				</span>
	        					</div>
	        				</div>
	      				</form>
	      				<ul class="nav navbar-nav navbar-right">
	      					<li><a href="#">Link <span class="sr-only">(current)</span></a></li>
	        				<li><a href="#">Link</a></li>
	        				<li class="dropdown">
	          					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
	          					<ul class="dropdown-menu">
						            <li><a href="#">Action</a></li>
						            <li><a href="#">Another action</a></li>
						            <li><a href="#">Something else here</a></li>
						            <li role="separator" class="divider"></li>
						            <li><a href="#">Separated link</a></li>
						            <li role="separator" class="divider"></li>
						            <li><a href="#">One more separated link</a></li>
	          					</ul>
	        				</li>
		      				
							@if(Route::has('login'))
					            
					                @if (Auth::check())
					                    <li><a href="{{ url('/home') }}">Home</a></li>
					                @else
					                    <li><a href="{{ url('/login') }}">Login</a></li>
					                    <li><a href="{{ url('/register') }}">Register</a></li>
					                @endif
					        @endif
						   
	        				

	        				<!-- <li class="dropdown">
	          					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
	          					<ul class="dropdown-menu">
						            <li><a href="#">Action</a></li>
						            <li><a href="#">Another action</a></li>
						            <li><a href="#">Something else here</a></li>
						            <li role="separator" class="divider"></li>
						            <li><a href="#">Separated link</a></li>
	          					</ul>
	        				</li> -->
	      				</ul>
    				</div><!-- /.navbar-collapse -->
  				</div><!-- /.container-fluid -->
			</nav>
   		</div>
   	</div>

   	<div class="con">
   		
   				<img src="{{asset('img/kids.jpg')}}" alt="image not found" > 
   				<div class="box">
   					
   						<h1>Guide your child to a great future</h1>
   						<h3>Find a great school	</h3>
   					</div>
   					
   				
 			
   		
   	</div>
	    

	<div class="col-md-12">

		<div class="col-md-3"> 11
		</div>

		<div class="col-md-3">22
		</div>

		<div class="col-md-3">33
		</div>

		<div class="col-md-3">987
		</div>

	</div>
	<div class="footer">
		<div class="container">
			<div class="col-md-6"> 11
			</div>

			<div class="col-md-2">22
			</div>

			<div class="col-md-2">33
			</div>

			<div class="col-md-2">987
			</div>
			</div>
	</div>
	
</body>
</html>