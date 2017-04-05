@extends('layouts.forumfinder_default')
@section('user_content')

	@if($schools->count())
		<section class="container-fluid tab_schools">
			<div class="texts text-center">
				<div class="container">
					<h2>Trusted Schools</h2>
				</div>
			</div>
			<div class="container">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a href="#Latest" aria-controls="Latest" role="tab" data-toggle="tab">
						 	Latest
						 </a>
					</li>
					<li role="presentation">
						<a href="#Popular" aria-controls="Popular" role="tab" data-toggle="tab">
							Popular 
						</a>
					</li>
					<li role="presentation">
						<a href="#Highest_Rated" aria-controls="Highest_Rated" role="tab" data-toggle="tab">
							Highest Rated
						</a>
					</li>
					<li role="presentation">
						<a href="#Oldest" aria-controls="Oldest" role="tab" data-toggle="tab">
							Oldest
						</a>
					</li>
					<li role="presentation">
						<a href="#lowest_Rated" aria-controls="lowest_Rated" role="tab" data-toggle="tab">
							lowest Rated
						</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="Latest">
						@foreach($schools_latest as $school)
							
						<div class="container border_con">
							<div class="col-xs-12 col-sm-3 pull-left">
								<img  src="image/commerce.jpg">
							</div>
							<div class="heading col-xs-12 col-sm-9 pull-right">
								<h3>{{$school->school_name}}</h3>
								<p>
									Commerce stream is still a very popular choice among Indian
									students who have passed 10th standard. Briefly, it seemed like Science stream and its popularity had tarnished the image
									of Commerce stream. It made it look like this stream was reserved for students who were not too bright.					
								</p>
								<a href="show_school/{{ $school->id }}">
									<button type="submit" class="btn btn-primary btn-xs">
										Read More
									</button>
								</a>
							</div>
						</div>
						@endforeach
					</div>

					<div role="tabpanel" class="tab-pane fade in" id="Highest_Rated">
						<div class="col-xs-12 col-sm-3">
							<img  src="image/Medical.jpg">
						</div>
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
					
					<div role="tabpanel" class="tab-pane fade in" id="Popular">
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
					
					<div role="tabpanel" class="tab-pane fade in" id="lowest_Rated">
						
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

					<div role="tabpanel" class="tab-pane fade in active" id="Oldest">
						@foreach($schools_oldest as $school)
							
						<div class="container border_con">
							<div class="col-xs-12 col-sm-3 pull-left">
								<img  src="image/commerce.jpg">
							</div>
							<div class="heading col-xs-12 col-sm-9 pull-right">
								<h3>{{$school->school_name}}</h3>
								<p>
									Commerce stream is still a very popular choice among Indian
									students who have passed 10th standard. Briefly, it seemed like Science stream and its popularity had tarnished the image
									of Commerce stream. It made it look like this stream was reserved for students who were not too bright.					
								</p>
								<a href="show_school/{{ $school->id }}">
									<button type="submit" class="btn btn-primary btn-xs">
										Read More
									</button>
								</a>
							</div>
						</div>
						@endforeach
					</div>
					
					
					
				</div>
			</section>



	@else
	<h1>No Records in the database</h1>
	@endif
	dkmnfkv dk
	@endsection