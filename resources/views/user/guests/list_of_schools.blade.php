@extends('layouts.forumfinder_default')
@section('user_content')
	@if($schools->count())
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
					<div role="tabpanel" class="tab-pane fade in active" id="Commerce">
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
					<div role="tabpanel" class="tab-pane fade in" id="Medical">
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
					
					<div role="tabpanel" class="tab-pane fade in" id="Non-Medical">
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
					
					<div role="tabpanel" class="tab-pane fade in" id="Arts">
						
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
	<div>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#home" aria-controls="home" role="tab" data-toggle="tab">
					Home
				</a>
			</li>
			<li role="presentation">
				<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
					Profile
				</a>
			</li>
			<li role="presentation">
				<a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">
					Messages
				</a>
			</li>
			<li role="presentation">
				<a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
					Settings
				</a>
			</li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
				@foreach($schools as $school)
				{{$school->id}}
				@endforeach
			</div>
			<div role="tabpanel" class="tab-pane" id="profile">
				@foreach($schools as $school)
				{{$school->school_name}}
				@endforeach
			</div>
			<div role="tabpanel" class="tab-pane" id="messages">
				@foreach($schools as $school)
				{{$school->school_address}}
				@endforeach
			</div>
			<div role="tabpanel" class="tab-pane" id="settings">
				@foreach($schools as $school)
				{{$school->location_id}}
				@endforeach
			</div>
		</div>
	</div>
	@else
	<h1>No Records in the database</h1>
	@endif
	@endsection