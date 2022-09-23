<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date'];

    protected $guarded = [];


    public static function buscar_eventos($search){

        if($search != null){

            $result = Event::where([['title', 'like', '%'.$search.'%']])->get();

            return $result;
        }
        else {
            return null;
        }
    }


    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function users() {
        return $this->belongsToMany('App\Models\User');
    }

    public function eventCategory () {

        return $this->belongsTo(EventCategory::class);

    }
}