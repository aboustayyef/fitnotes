@extends('layouts.app')

@section('content')

<div class="container">
	@{{status}} 
</div>
<hr>
<div class="container">
	<div class="row">
		<div v-if="this.dataLoaded !== true " class="col-md-4">
			<vue2-dropzone 
		        ref="myVueDropzone" id="dropzone" 
		        :options="dropzoneOptions"
		        v-on:vdropzone-complete="refreshData()"
		    >
		</div>
		<div v-else class="col-md-4">
			<day-chooser v-on:dayselected="updateSelectedData" :fn-data="fnData"></day-chooser>
		</div>

		<div class="col-md-8">
	        <fitnotes-viewer :selected_date_workouts="this.selected_date_workouts"></fitnotes-viewer>
		</div>
	</div>
</div>
@endsection
