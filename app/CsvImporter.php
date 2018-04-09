<?php

namespace App;
use App\Exercise;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use League\Csv\Reader;
use \DB;

class CsvImporter
{
    private $csv;
    public static function process(){
        $csv = Reader::createFromPath(storage_path() . '/app/'.Auth::user()->id.'_exercises.csv');
        // clear exisiting records for user
        if (Auth::user()->exercises()->count() > 0) {
            Auth::user()->exercises()->delete();
        }
        DB::table('exercises')->truncate(); 
        // Remove Headers
        $exercises = collect($csv->setOffset(1)->fetchAll());
        // return $exercises;    
        $exercises = $exercises->map(function($exercise){

            // handle multiple categories into one string
            $categories = $exercise[13];
            if (sizeof($exercise) > 14){
                for ($i=14; $i < sizeof($exercise); $i++) { 
                    $categories .= ' '. $exercise[$i];
                }
            }
            return [
                'name' => $exercise[0], // Name of exercise
                'start' => new Carbon($exercise[1] . ' ' . $exercise[2]), // start timestamp
                'end' => new Carbon($exercise[3] . ' ' . $exercise[4]), // end timestamp
                'bodyweight' => (float) $exercise[5],
                'exercise' => $exercise[6],
                'equipment' => $exercise[7],
                'reps' => (int) $exercise[8],
                'weight' => (float) $exercise[9],
                // convert "00:00:00" to seconds. source in link below:
                // https://stackoverflow.com/questions/4834202/convert-time-in-hhmmss-format-to-seconds-only
                'time' => strlen($exercise[10]) > 0 ? strtotime("1970-01-01 " . $exercise[10] . " UTC") : 0,
                'distance' => (int) $exercise[11],
                'done' => $exercise[12] == "Done" ? 1 : 0,
                'categories' => $categories
            ];
        });
        Auth::user()->createMany($exercises);
    }

    public function index(Request $request){

        // Begin Import Process



        

        // select only the fields that are needed and apply some formatting and casting ;
        $goods = $goods->map(function($good){
        return [
            $good[0], // Code
            $good[1], //  Name
            $good[2], //  Brand
            $good[3], //  Description
            $good[5], //  Supplier
            round((float) $good[6],3), // Price Ex
            round((float) $good[7],3), // Price in
            round((float) $good[8],3), // Value
            (int) $good[12], // Stock
            ];
        })->filter(function($good){ 
            return $good[8] > 0; // make sure to import only items with stock > 0
        });

        // Now Populate db with processed info

        $goods->each(function($item, $key){
            $record = new Good;
            $record->Code = $item[0];
            $record->Name = $item[1];
            $record->Brand = $item[2];
            $record->Description = $item[3];
            $record->Supplier = $item[4];
            $record->PriceEx = $item[5];
            $record->PriceIn = $item[6];
            $record->Value = $item[7];
            $record->Stock = $item[8];
            $record->AddedToInvoice = 0;
            $record->save();
        });

        $request->session()->flash('status', 'Ok');
        $request->session()->flash('message', $goods->count() . ' Records Successfully imported');

        return redirect('/');
    }
}