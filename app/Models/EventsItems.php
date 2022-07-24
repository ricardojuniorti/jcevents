<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsItems extends Model
{
    use HasFactory;

    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date'];

    protected $guarded = [];


    public static function inserir($events_id, $items_id)
    {
        if ($items_id != null) {
            $registro = EventsItems::create([
                'events_id' => $events_id,
                'items_id' => $items_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return $registro;

        }
        else {

            return null;
        }
    }

    public static function excluir($eventId,$itemId) 
    {
        if ($eventId != null && $itemId != null) {
            
            $registro = EventsItems::where('events_id', $eventId)
                    ->where('items_id',$itemId)
                    ->delete();
            
            return $registro;
        }
        else{

            return null;

        }
        
    }  

}