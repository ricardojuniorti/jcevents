<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'description',
        'active',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date'];

    protected $guarded = [];


    public static function recuperarItemsEvents() {

        $registro = DB::table('items')
        ->select('id','description')
        ->orderByRaw('items.description ASC')
        ->get();

        if ($registro != null){
            return $registro;
        }
        else{
            return null;
        }

    }

    public static function recuperarItemsEventsPeloId($id = null) {

        if($id != null){

            $registro = DB::table('items')
                    ->where('events_items.events_id', $id)
                    ->select('items.id as id','items.description as description')
                    ->orderByRaw('items.description ASC')
                    ->Join('events_items', 'events_items.items_id', '=', 'items.id')
                    ->get();
        
            return $registro;

        }

        else{
            return null;
        }

    }

    public static function recuperarItemsEventsNaoSelecionadosPeloId($id = null) {

        if($id != null){

            $registro = DB::select('select id, description from items where id not in 
            (SELECT i.id as id from items i join events_items ei on (i.id = ei.items_id) where ei.events_id = :id)', ['id' => $id]);
        
            return $registro;

        }

        else{
            return null;
        }

    }

}