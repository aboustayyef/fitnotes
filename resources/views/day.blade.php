<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Workout Day</title>
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>
	<div class="section">
		<div class="container">
			@foreach($day as $workoutname => $workout)
				<h2 class="is-2 title">{{$workoutname}}</h2>
				{{-- To do: Also include workout details. start time, end time, body weight --}}
				@foreach($workout as $exercisename => $exercise)
					<h3 class="is-4 title">{{$exercisename}}</h3>
					@include('exercisetable', compact('exercise'))
				@endforeach
			@endforeach()
		</div>
	</div>
</body>
</html