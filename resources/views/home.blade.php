@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('fn_message'))
    <div class="alert alert-primary" role="alert">
        {{Session::get('fn_message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @foreach ($errors->get('csv') as $message) 
        <small>{{$message}}</small>
    @endforeach
            <form action="/upload" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="csv" class="custom-file-input" id="exampleInputFile" aria-describedby="fileHelp">
                <label class="custom-file-label" for="exampleInputFile">
                   Select file to import...
                </label>
                <button v-on:click="clearStorage" id="nameOfFile" type="submit" class="btn btn-primary float-right">Upload</button>
            </form>
            <fitnotes-viewer :fn-data="fnData"></fitnotes-viewer>
        </div>
@endsection
