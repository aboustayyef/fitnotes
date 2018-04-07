<?php

namespace App;
use App\Workout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use League\Csv\Reader;
use \DB;

class CsvImporter
{
    private $csv;
    public static function process(){
        $csv = Reader::createFromPath(storage_path() . '/app/workouts.csv');
        // clear exisiting database
        DB::table('workouts')->truncate(); 
        // Remove Headers
        $workouts = collect($csv->setOffset(1)->fetchAll());
        // return $workouts;    
        $workouts = $workouts->map(function($workout){

            // handle multiple categories into one string
            $categories = $workout[13];
            if (sizeof($workout) > 14){
                for ($i=14; $i < sizeof($workout); $i++) { 
                    $categories .= ' '. $workout[$i];
                }
            }
            return [
                'name' => $workout[0], // Name of Workout
                'start' => new Carbon($workout[1] . ' ' . $workout[2]), // start timestamp
                'end' => new Carbon($workout[3] . ' ' . $workout[4]), // end timestamp
                'bodyweight' => (float) $workout[5],
                'exercise' => $workout[6],
                'equipment' => $workout[7],
                'reps' => (int) $workout[8],
                'weight' => (float) $workout[9],
                // convert "00:00:00" to seconds. source in link below:
                // https://stackoverflow.com/questions/4834202/convert-time-in-hhmmss-format-to-seconds-only
                'time' => strlen($workout[10]) > 0 ? strtotime("1970-01-01 " . $workout[10] . " UTC") : 0,
                'distance' => (int) $workout[11],
                'done' => $workout[12] == "Done" ? 1 : 0,
                'categories' => $categories
            ];
        });
        foreach ($workouts as $key => $workout) {
            Workout::create($workout);
        }
        return $workouts;
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