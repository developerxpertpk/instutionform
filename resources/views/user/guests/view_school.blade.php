@extends('layouts.forumfinder_default')
@section('user_content')

	@if(isset($particular_school))
		@if(count($particular_school))
			@foreach($particular_school as $school)
			{{ $school->locations }}
			@endforeach

		@endif
	@else
		<script type="text/javascript">
			 window.location.href = '{{ url("/")}}';
		</script>
	@endif

@endsection