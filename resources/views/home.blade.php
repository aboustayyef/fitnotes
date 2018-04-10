@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form action="/upload" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="file">
                <label class="file-label">
                    <input class="file-input" type="file" name="csv">
                    <span class="file-cta">
                        <span class="file-label">Choose a CSV File</span>
                    </span>
                </label>
                &nbsp;
                <button id="nameOfFile" type="submit" class="button is-warning">Upload</button>
            </div>
        </form>
    </div>
    <div class="row">
        <fitnotes-viewer :fn-data="fnData"></fitnotes-viewer>
    </div>
@endsection
