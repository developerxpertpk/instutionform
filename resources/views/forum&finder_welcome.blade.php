<!DOCTYPE html><!--Final Design-->
<html>
<head>
	<script src="{{asset('js/app.js')}}" type="text/javascript"></script>
    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="{{ asset('css/custom_project.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/coding.css') }}">

</head>
<body>

<header>
<div class="container-fluid navigation">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="image\finallogo.png"></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">School Details</a></li>
               <li><a href="#">List of Schools</a></li>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            @if(Route::has('login'))            
                @if (Auth::check())
                    <li><a href="{{ url('/home') }}">Home</a></li>
                @else
                    <li><a href="{{ url('/login') }}">Login</a></li>
              		<li><a href="{{ url('/register') }}">Register</a></li>
                @endif
	        @endif
              
              
            </ul>
          </div>
		  </div>
      </nav>
</div>
      
</header>

<!-- banner and search portion --->
<section class="search_banner">
<div id="slidermy" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->

     <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="image\school1.jpg" alt="First slide">
        </div>
		
		<div class="item">
          <img src="image\school3.jpg" alt="Second slide">
         </div>
		 
		 <div class="item">
          <img src="image\school2.jpg" alt="Second slide">
         </div>
		 <div class="container">
            <div class="carousel-caption">
              <h1>Find the best schools</h1>
			
			  <div class="pad-top-120">
    <p>How does schools works ?</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
			</div>
         
        </div>
      </div>
		
		 <a class="left carousel-control" href="#slidermy" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#slidermy" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
      </div> 
	  <div class="search-container">
	  <div class="container search_control">
  <div class="col-xs-12 col-sm-4">
    <input type="text" class="form-control input-lg" placeholder="Search the location">
  </div>
  <div class="col-xs-12 col-sm-6">
    <input type="text" class="form-control input-lg" placeholder="Enter the name of school ">
  </div>

	
<div class="col-xs-12 col-sm-2">	
<button type="button" class="btn btn-success btn-lg">Search</button></div>
	
	
	</div>
	 </div>
	  </section>
	  
	  <!--Features portion-->
	  <section class="features">
	  <div id="slider" class="carousel slide" data-ride="carousel">
<div class="container">
  <h2>Featured School</h2>
	  <div class="carousel-inner" role="listbox">
        <div class="item active">
             <div class="col-xs-12 col-sm-3 Main_features">
			  <img src="image\oakridge.png">
				<h3 class="first-slide">Oakridge International....</h3>
				<h5>Chandigarh</h5>
				<p>This school is affiliated by Central Board of Education,provide all facilities to students.</p>
			</div>
			
			 <div class="col-xs-12 col-sm-3 Main_features">
			 <img src="image\school4.png">
				<h3 class="first-slide">Delhi Public School</h3>
				<h5>Srinagar</h5>
				<p>DPS is a co-educational senior secondary school in the Srinagar district of Jammu and Kashmir state, India. </p>
				
			</div>
			
			 <div class="col-xs-12 col-sm-3 Main_features">
			 <img src="image\sps.png">
				<h3 class="first-slide">Shivalik Public School</h3>
				<h5>Mohali</h5>
				<p>This is a Co-ed school with 378 students and scores a facility rating of 2.33 out of 5. </p>
			</div>
			
			 <div class="col-xs-12 col-sm-3 Main_features">
			 <img src="image\eicher.png">
				<h3 class="first-slide">Eicher School</h3>
				<h5>Sector 46, Faridabad</h5>
				<p>This is a Co-ed school with 378 students and scores a facility rating of 2.33 out of 5. </p>
			</div>
        </div>
		
		<div class="item">
             <div class="col-xs-12 col-sm-3 Main_features">
			 <img src="image\little.png">
				<h3 class="first-slide">Little Angles High....</h3>
				<h5>Sonipat</h5>
				<p>This is a Co-ed school with 378 students and scores a facility rating of 2.33 out of 5. </p>
			</div>
			
			 <div class="col-xs-12 col-sm-3 Main_features">
			 <img src="image\army.png">
				<h3 class="first-slide">B.Z.S.F.S public....</h3>
				<h5>Fatehgarah Sahib,Punjab</h5>
				<p>The school is affiliated to Punjab School Education Board Under the 10+2 with all streams.</p>
			</div>
			
			 <div class="col-xs-12 col-sm-3 Main_features">
			 <img src="image\gfs.png">
				<h3 class="first-slide">Green Field School</h3>
				<h5>Mohali</h5>
				<p>The school is affiliated to Central Board of Secondary Education Under the 10+2.</p>
			</div>
			
			 <div class="col-xs-12 col-sm-3 Main_features">
			 <img src="image\comb.png">
				<h3 class="first-slide">Cambridge International....</h3>
				<h5>Amritsar,Punjab</h5>
				<p>This is a Co-ed school with 378 students and scores a facility rating of 2.33 out of 5. </p>
			</div>
        </div>
	  <a class="left carousel-control" href="#slider" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#slider" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
	  </div>
	  </div>
	  </div>
	  </section>
	  

<section class="container-fluid tab_schools">

	<div class="texts text-center">
<div class="container">
<h2>Popular streams</h2>
<h4>Select your preferred and explore stream dream</h4>
</div>
</div>
		<div class="container">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#Commerce" aria-controls="Commerce" role="tab" data-toggle="tab"> Commerce</a></li>
    <li role="presentation"><a href="#Medical" aria-controls="Medical" role="tab" data-toggle="tab">Medical</a></li>
    <li role="presentation"><a href="#Non-Medical" aria-controls="Non-Medical" role="tab" data-toggle="tab">Non-Medical</a></li>
    <li role="presentation"><a href="#Arts" aria-controls="Arts" role="tab" data-toggle="tab">Arts</a></li>
	
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="Commerce">
	<div class="col-xs-12 col-sm-3"><img  src="image/commerce.jpg"></div>
	<div class="heading col-xs-12 col-sm-9">    
	<h3>Commerce stream is still a very popular choice among Indian 
	students who have passed 10th standard. Briefly.</h3>
    <p>
	Commerce stream is still a very popular choice among Indian 
	students who have passed 10th standard. Briefly, it seemed like Science stream and its popularity had tarnished the image 
	of Commerce stream. It made it look like this stream was reserved for students who were not too bright. 
	
	</p>
</div>
</div>

    <div role="tabpanel" class="tab-pane " id="Medical">
	<div class="col-xs-12 col-sm-3"><img  src="image/Medical.jpg"></div>
	<div class="heading col-xs-12 col-sm-9">    
<h3>Medical stream is still a very popular choice among Indian 
	students who have passed 10th standard.  </h3>	
    <p>
	Medical stream is still a very popular choice among Indian 
	students who have passed 10th standard. Briefly, it seemed like Science stream and its popularity had tarnished the image 
	of Medical stream. It made it look like this stream was reserved for students who were not too bright.
	It made it look like this stream was reserved for students who were not too bright. 
	
	</p>
	</div>
	</div>
	
    <div role="tabpanel" class="tab-pane" id="Non-Medical">
	<div class="col-xs-12 col-sm-3"><img  src="image/non.jpg"></div>
	<div class="heading col-xs-12 col-sm-9">    
	<h3>Non-Medical stream is still a very popular choice among Indian 
	students who have passed 10th standard.</h3>
    <p>
	Non-Medical stream is still a very popular choice among Indian 
	students who have passed 10th standard. Briefly, it seemed like Science stream and its popularity had tarnished the image 
	of Non-Medical stream. It made it look like this stream was reserved for students who were not too bright.
	</p>
	</div>
	</div>
	
    <div role="tabpanel" class="tab-pane" id="Arts">
	
	<div class="col-xs-12 col-sm-3"><img  src="image/arts.jpg"></div>
	<div class="heading col-xs-12 col-sm-9">    
    <h3>Arts stream is still a very popular choice among Indian 
	students who have passed 10th standard.</h3>
	
	<p>
	Arts stream is still a very popular choice among Indian 
	students who have passed 10th standard. Briefly, it seemed like Science stream and its popularity had tarnished the image 
	of Arts stream. It made it look like this stream was reserved for students who were not too bright.
	</p>
	 </div>
	 </div>
	 
	
 
 </div>
  </section>
  
  <!--Trending Schools-->
<section class="Trend_School">
<div class="container">
<h2>Trending Schools</h2>
<h5>Explore the school that are currently popular</h5>
<div class="col-xs-12 col-sm-3 t_school">
<img src="image\oakridge.png">
<h5>Oakridge International School,Chandigarh</h5>
     </div>
	 
	 <div class="col-xs-12 col-sm-3 t_school">
<img src="image\dpsschool.png">
<h5>Delhi Public School,Srinagar</h5>
     </div>
	 
	  <div class="col-xs-12 col-sm-3 t_school">
<img src="image\sps.png">
<h5>Shivalik Public School,Srinagar</h5>
     </div>
	 
	 <div class="col-xs-12 col-sm-3 t_school">
<img src="image\comb.png">
<h5>Combridge international School,Srinagar</h5>
     </div>
	 <div class="col-xs-12 col-sm-3 t_school">
<img src="image\gfs.png">
<h5>Green Field School,Srinagar</h5>
     </div>
	 
	 <div class="col-xs-12 col-sm-3 t_school">
<img src="image\army.png">
<h5>Army Publi School,Srinagar</h5>
     </div>
	 <div class="col-xs-12 col-sm-3 t_school">
<img src="image\school4.png">
<h5>Combridge international School,Srinagar</h5>
     </div>
	 <div class="col-xs-12 col-sm-3 t_school">
<img src="image\eicher.png">
<h5>Eicher School,Srinagar</h5>
     </div>
	 
	 </div>
	 </section>
	 
 <!--Guidance portion-->
	 <section class="Guidance">
	 <div class="container">
	 <h2>Guidance</h2>
	 <div class="col-xs-12 col-sm-6 guide query">
	 <div class="media">
  <div class="media-left">
    <a href="#">
      <img class="media-object" src="image\student2.png">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading">Media heading</h4>
    <p>This site provided me with latest information on schools. 
	Regular reminders on important deadlines helped me stay on top of all my college and exam applications.
	<h6>Ritu Bhardwaj Teacher Shivalik Public School,Srinagar</h6> 
	</p><button type="submit" class="btn btn-primary btn-xs">Read More</button>
  </div>
</div>

<div class="media">
  <div class="media-left">
    <a href="#">
      <img class="media-object" src="image\teach.png">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading">Media heading</h4>
    <p>Shiksha provided me with latest information on colleges and exams. 
	Regular reminders on important deadlines helped me stay on top of all my college and exam applications.
	<h6>Pawan Uppal Teacher Delhi Public School,Delhi</h6> 
	</p>
	<button type="submit" class="btn btn-primary  btn-xs">Read More</button>
  </div>
</div> 
</div>


<!--form-->
<div class="col-xs-12 col-sm-6 guide">
 <div class="media">
  <div class="media-left">
    <a href="#">
      <img class="media-object" src="image\gg.png">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading">Media heading</h4>
    <p>This site provided me with latest information on schools. 
	Regular reminders on important deadlines helped me stay on top of all my college and exam applications.
	<h6>Simpy Dora Teacher Green Field School,Mohali</h6> 
	</p><button type="submit" class="btn btn-primary  btn-xs">Read More</button>
  </div>
</div>

<div class="media">
  <div class="media-left">
    <a href="#">
      <img class="media-object" src="image\student1.png">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading">Media heading</h4>
    <p>Shiksha provided me with latest information on colleges and exams. 
	Regular reminders on important deadlines helped me stay on top of all my college and exam applications.
	<h6>Neha Thakur Teacher Army Public School,Mumbai</h6> 
	</p>
	<button type="submit" class="btn btn-primary  btn-xs">Read More</button>
  </div>
</div>
	
  </div>
  </div>
	 </section>
	 </form>
	 
	 <!--Footer Portion-->
<footer id="footer" class="dark">
<div class="primary-footer">
<div class="container">
<div class="row">
<div class="col-md-4">
<div class="col-md-12 col-sm-12">
<div class="head5">About Us</div>
<ul class="f-list"><span>Passionate about simplifying schooling decisions, Sqoolz.com offers students, parents and schools an extensive online ecosystem. 
Admission seekers can discover the best schools in the neighbourhood and refine search results based on board, location, facilities, language and gender.</span></ul></div></div>
<div class="col-md-8"><div class="col-md-12 col-sm-12">
<div class="col-md-4 col-sm-4">
<div class="head5">For Schools</div>
<ul class="f-list"><li><a href="/addSchool" target="_blank">
<h3>Add Your School</h3></a></li><li><a href="mailto:sales@sqoolz.com">
<h3>Claim Your Listing</h3></a></li>
<li><a href="https://connect.schoolfinder.co.in/" target="_blank">
<h3>Parent Connect</h3></a></li>
<li><a href="https://acquire.sqoolz.com/login" target="_blank">
<h3>Student Acquisition</h3></a></li></ul></div>
<div class="col-md-4 col-sm-4"><div class="head5">Help</div>
<ul class="f-list"><li><a href="mailto:info@sqoolz.com">
<h3>Contact Us</h3></a></li><li><a href="/directory" target="_blank"><h3>Sitemap</h3></a></li>
<li><a href="mailto:info@sqoolz.com">
<h3>Facebook</h3></a></li>
<li><a href="mailto:info@sqoolz.com">
<h3>Twitter</h3></a></li>

<li><div class="pull-left"><div class="social-link circle a data-toggle="tooltip" data-placement="auto" data-original-title="Facebook" class="facebook" href="/externalLink?link=https://www.facebook.com/sqoolz" target="_blank">
<i class="fa fa-facebook"></i></a>
<a data-toggle="tooltip" data-placement="auto" data-original-title="Twitter" class="twitter" href="/externalLink?link=https://twitter.com/sqoolzhq" target="_blank"><i class="fa fa-twitter"></i></a>
<a data-toggle="tooltip" data-placement="auto" data-original-title="Google Plus" class="google" href="/externalLink?link=https://plus.google.com/%2BSqoolz" target="_blank">
<i class="fa fa-google-plus"></i>
</a></div></div></li></ul></div>
<div class="col-md-4 col-sm-4">
<div class="head5">Terms</div>
<ul class="f-list">
<li><a href="/termsofuse">
<h3>Terms Of Use</h3>
</a></li>
<li>
<a href="/privacypolicy">
<h3>Privacy Policy</h3></a></li>
<li><a href="https://www.sqoolz.com/what-we-do/" target="_blank">
<h3>What We Do</h3></a></li></ul></div></div></div></div></div></div>


<div class="primary-footer botom_f">
<div class="container"><div class="row">
<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
<div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
<ul class="f-list"><li><a href="/schools/Pune" target="_blank">
<h3>Best schools in Pune</h3></a></li>
<li><a href="/schools/Mumbai" target="_blank">
<h3>Best schools in Mumbai</h3></a></li><li><a href="/schools/Delhi" target="_blank">
<h3>Best schools in Delhi</h3></a></li><li><a href="/schools/Bangalore" target="_blank">
<h3>Best schools in Bangalore</h3></a></li></ul></div><div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
<ul class="f-list"><li><a href="/schools/Chennai" target="_blank"><h3>Best schools in Chennai</h3></a></li>
<li><a href="/schools/Hyderabad" target="_blank"><h3>Best schools in Hyderabad</h3></a></li>
<li><a href="/schools/Kolkata" target="_blank"><h3>Best schools in Kolkata</h3></a></li>
<li><a href="/schools/Ahmedabad" target="_blank">
<h3>Best schools in Ahmedabad</h3>
</a></li></ul></div>
<div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
<ul class="f-list"><li><a href="/schools/Coimbatore" target="_blank">
<h3>Best schools in Coimbatore</h3></a></li>
<li><a href="/schools/Indore" target="_blank">
<h3>Best schools in Indore</h3></a></li>
<li><a href="/schools/Darjeeling" target="_blank">
<h3>Best schools in Darjeeling</h3></a></li>
<li><a href="/schools/Dehradun" target="_blank">
<h3>Best schools in Dehradun</h3></a></li></ul></div>
<div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
<ul class="f-list">
<li><a href="/schools/Panchgani" target="_blank">
<h3>Best schools in Panchgani</h3></a></li></ul>
</div></div></div></div></div>

<div class="secondary-footer"><div class="container">
<div><div class="col-md-12 text-color pull-left">
<span>© 2017 By <a href="http://www.wishtreetech.com" target="_blank" class="text-color">Talentelgia Technologies LLP.</a> All Rights Reserved </span></div></div></div></div>

<div></div>
</footer>	   
</body>
</html>

