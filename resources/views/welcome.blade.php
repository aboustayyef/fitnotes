<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
        <title>Fitnotes</title>
        <!-- Styles -->
    </head>
    <style>
        body{
            padding:3em;
        }
    </style>
    <body>
        <form action="{{route('workout.store')}}" method="post" enctype="multipart/form-data">
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
    </body>
</html>
