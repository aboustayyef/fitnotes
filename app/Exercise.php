<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ['name','start','end','bodyweight','exercise','equipment','reps','weight','time','distance','done','categories'];

    public function user(){
    	return $this->belongsTo(\App\User::class);
    }

}