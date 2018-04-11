<?php

namespace App\Http\Controllers;

use App\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $request->validate([
            'csv'   =>  'required|mimes:csv,txt'
        ]);
        $request->csv->storeAs('/','exercises.csv');
        return \App\CsvImporter::process();
        // to do: redirect to success page or Error
    }

}
