@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
            @auth
                {{-- Authorised Users see upload form --}}
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
            @else
                You need to be logged in
            @endauth
</div>
@endsection
