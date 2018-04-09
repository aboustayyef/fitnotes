@extends('layouts.app')
@section('content')
<div class="container">
	@foreach($day as $workoutname => $workout)
		<h2>{{$workoutname}}</h2>
		{{-- To do: Also include workout details. start time, end time, body weight --}}
		@foreach($workout as $exercisename => $exercise)
			<h3>{{$exercisename}}</h3>
			@include('exercisetable', compact('exercise'))
		@endforeach
	@endforeach()
</div>
@stop