<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Workout Day</title>
</head>
<body>
	@foreach($day as $workoutname => $workout)
		<h1>{{$workoutname}}</h1>
		{{-- To do: Also include workout details. start time, end time, body weight --}}
		@foreach($workout as $exercisename => $exercise)
			<h3>{{$exercisename}}</h3>
			@include('exercisetable', compact('exercise'))
		@endforeach
	@endforeach()
</body>
</html