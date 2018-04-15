<?php

namespace App;
use App\Exercise;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use League\Csv\Reader;
use \DB;

class CsvImporter
{
    private $csv;
    public static function process(){
        $csv = Reader::createFromPath(storage_path() . '/app/exercises.csv');

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
                'start' => $exercise[1] . ' ' . $exercise[2], // start timestamp
                'end' => $exercise[3] . ' ' . $exercise[4], // end timestamp
                'day' => (new Carbon($exercise[1] . ' ' . $exercise[2]))->toDateString(),
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
        Cache::put('fnData', $exercises, 5);
        return Cache::get('fnData'); 
    }
}