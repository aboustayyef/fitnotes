<?php
	$focus = [];
	$ex = [ 
		'reps'		=>	$exercise->first()['reps'],
		'distance'	=>	$exercise->first()['distance'],
		'time'		=>	$exercise->first()['time'],
		'weight'	=>	$exercise->first()['weight']
	] ;

	foreach ($ex as $key => $value) {
		if ($value > 0) {
			$focus[] = $key;
		}
	}
?>
@foreach($exercise as $set)
	@foreach($focus as $focusItem)
		{{$focusItem}} =====
	@endforeach
	<hr>
	@foreach($focus as $focusItem)
		{{$set[$focusItem]}} =====
	@endforeach
	<hr>
@endforeach()