@extends('layouts.forumfinder_default')
@section('user_content')
	
	@if(isset($faq_data))

		<section class="Trend_School">
			<div class="container">	
				<h2>FAQ</h2>
				<h5>(Frequently Asked Questions)</h5>

		@if(count($faq_data))

			@foreach($faq_data as $data)
				<a href="#" class="faq_anchor">
					<h4 data-toggle="collapse" data-target="#ans{{$data->id}}">
						<div class="col-md-1">
							Ques: 
						</div>
						{{$data->question}}
					</h4>
				</a>
				<div id="ans{{$data->id}}" class="collapse">
					<div class="col-md-1">
						<p><strong>Answer:</strong></p>
					</div>
					<p>{{$data->answer}}</p>
				</div>
			@endforeach

		@else

		@endif

			</div>
		</section>

	@endif

@endsection