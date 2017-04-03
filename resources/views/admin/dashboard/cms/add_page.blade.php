<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
  <script src='//cloud.tinymce.com/stable/tinymce.min.js'></script>
  <script>
  tinymce.init({
    selector: '#mytextarea',
	theme: 'modern',
    width: 600,
    height: 300,
	inline:true,
	 plugins: [
			  'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
			  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
			  'save table contextmenu directionality emoticons template paste textcolor'
	],

	  content_css: 'css/content.css',
	 toolbar:[ 'undo redo | styleselect | bold italic | link image',
				'alignleft aligncenter alignright'
	 
	 ]
  });
  </script>

	<link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
	<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
  
</head>
<body>
 <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation </span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="route('admin.dashboard')"> Admin </a>
            </div>
            <div></div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong> </strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong></strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong></strong>
                                        </h5>
                                         <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{  Auth::user()->fname." ".Auth::user()->lname }}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                           <a href=" {{ route('admin.profile') }}"> <i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li>
                            <a href= "{{ route('admin.changepwd') }}" ><i class="fa fa-fw fa-gear"></i> Change Password</a>
                        </li>

                        <li class="divider">logout</li>
                        <li>
                            <a href="{{ route('logout') }}"

                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"> <i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href=" {{ route('admin.dashboard') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('charts') }}"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
                    </li>
                    <!-- users data -->
                     <li>
                        <a href="{{ route('user.index')}}"><i class="fa fa-fw fa-user"></i> Users </a>
                    </li>
                    <li>
                        <a href="{{route('school.index')}}"><i class="fa fa-fw fa-table"></i> School</a>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v" ></i> CMS <class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="{{route('content')}}"> Content Manager</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li>
 
                    <li>
                        <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
                    </li>
                    <li>
                        <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
                    </li>
                    <li>
                        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
		  <!-- /.wapper-collapse -->
	
		  <div id="page-wrapper">
			<div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">
                           Content Manager
                        </h2>
					</div>
				</div>
		<div class="pagecontainer">
		  <div class="pagoverflow">
			<form   method="post" class="form-horizontal" role="form"  enctype="multipart/form-data" action="{{route('school.store')}}">
              {{ csrf_field() }}
			
				<div class="row">
					<div class="col-lg-12">
						<h3> Add Page Content</h3>
						<div class="pull-right">	
							<a class="btn btn-success"  type= "submit" href="{{ route('content')}}"> Submit </a>
							<a class="btn btn-danger" href="{{ route('content')}}"> Back </a>
						</div>	
					</div>
                </div>
				
				<div class="form-group">
					<label class="col-sm-6 col-md-4 col-lg-4 control-label"> *Content Type </label>
					
					<div class="col-sm-6 col-md-6 ">
						<select id="content_type" type="text" class="form-control" name="Content_type" required autofocus>
							
							<option value="">Content</option>
								<option value="yellow">Static </option>
								<option value="purple">Error Pgae</option>
								<option value="purple">Redirecting Link</option>
								<option value="purple">Interpage Link</option>
								<option value="purple">Section Header</option>
						
						</select>
				
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-6 col-md-4 col-lg-4 control-label"> *Title </label>
					<div class="col-sm-6 col-md-6 ">
						<input id="title" type="text" class="form-control" name="title" required autofocus>
					
					</div>
				</div>
	
				<div class="form-group">
					<label class="col-sm-6 col-md-4 col-lg-4 control-label"> *Content </label>
						<div class="col-sm-6 col-md-6 ">
						<textarea id="mytextarea" name="content"></textarea>
					</div>
				
			  </form>  
			</div>
			</div>
		</div>
		</div>
		</div>

	 <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>
</html>