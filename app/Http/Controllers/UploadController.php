<?php

namespace App\Http\Controllers;

use App\Exercise;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->csv->storeAs('/', 'exercises.csv');
        return \App\CsvImporter::process();
        // to do: redirect to success page or Error
    }

}
