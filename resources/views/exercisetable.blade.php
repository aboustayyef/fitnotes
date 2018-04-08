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
			<th width="28%">{{$focusItem}}</th>
		@endforeach
			<th width="10%">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		@foreach($exercise as $key => $set)
			<tr>
				<td>{{$key + 1}}</td>
			@foreach($focus as $focusItem)
				@if($focusItem == 'time')
					<td>{{sprintf('%02d:%02d:%02d', ($set[$focusItem]/3600),($set[$focusItem]/60%60), $set[$focusItem]%60)}}</td>
				@else
					<td>{{$set[$focusItem]}}</td>
				@endif
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
