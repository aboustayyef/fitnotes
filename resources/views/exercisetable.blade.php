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
<table class="table is-fullwidth is-striped">
	{{-- headers --}}
	<thead>
		<tr>
			<th>Set #</th>
		@foreach($focus as $focusItem)
			<th width="25%">{{$focusItem}}</th>
		@endforeach
			<th width="7%">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		@foreach($exercise as $key => $set)
			<tr>
				<td>{{$key + 1}}</td>
			@foreach($focus as $focusItem)
				<td>{{$set[$focusItem]}}</td>
			@endforeach
				<td>
					@if($set['done'])
						&#10003;
					@endif
				</td>
			</tr>
		@endforeach()
	</tbody>
	
</table>
{{-- data --}}
