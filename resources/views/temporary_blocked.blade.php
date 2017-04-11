<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Blocked</title>
		<!-- Bootstrap -->
		<link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
		<!-- NProgress -->
		<link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
		<!-- Custom Theme Style -->
		<link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('css/custom.css')}}">
		<style type="text/css">
			body{
				background-color: #E1E3E4;
			}
		</style>
	</head>
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<!-- page content -->
				<div class="col-md-12">
					<div class="col-middle">
						<div class="text-center text-center">
							<h1 class="error-number">404</h1>
							<h2>Access Denied</h2>
							<p>You have been temporary blocked !! <a href="#">Report this?</a>
						</p>
						<div class="mid_center">
							<h3>Search</h3>
							<form>
								<div class="col-xs-12 form-group pull-right top_search">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search for...">
										<span class="input-group-btn">
											<button class="btn btn-default" type="button">Go!</button>
										</span>
									</div>
								</div>
							</form>
							<p><a href="/">back to home...</a></p>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->
		</div>
	</div>
	<!-- jQuery -->
	<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
	<!-- Bootstrap -->
	<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
	<!-- FastClick -->
	<script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>
	<!-- NProgress -->
	<script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>
	<!-- Custom Theme Scripts -->
	<script src="{{asset('build/js/custom.min.js')}}"></script>
</body>
</html>