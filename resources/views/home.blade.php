@extends('layouts.app')

@section('content')

<div class="container">
	@{{status}} 
</div>
<hr>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<vue2-dropzone 
		        ref="myVueDropzone" id="dropzone" 
		        :options="dropzoneOptions"
		        v-on:vdropzone-complete="refreshData()"
		    >
		</div>
		<div class="col-md-6">
			<fitnotes-viewer :fn-data="fnData"></fitnotes-viewer>
		</div>
	</div>
</div>
@endsection
