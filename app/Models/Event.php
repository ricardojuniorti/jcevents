<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
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

    public static function recuperar_top3_eventos(){

            $registro = DB::select('SELECT count(events.id) as qtde,events.title as title 
                                    FROM events 
                                    join 
                                        event_user on(events.id = event_user.event_id)  
                                    group by 
                                        events.id 
                                    order by 
                                        events.id asc
                                    limit 3 ');   
            return $registro;
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