<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageClasses extends Model
{
    use HasFactory;

    protected $table = 'message_classes';
    protected $fillable = [
        'id',
        'message',
        'classes_id',
        'user_id',
        'created_at',
        'updated_at',
    ];
    
    public static function buscar_mensagens($id = null) {

        if($id != null){

            $registro = DB::table('message_classes')
                    ->where('message_classes.classe_id', $id)
                    ->select('message_classes.id as id','message_classes.classe_id as classe_id','users.id as user_id','users.name as name','users.created_at as data_envio','message_classes.message as message')
                    ->orderByRaw('users.name ASC')
                    ->Join('users', 'message_classes.user_id', '=', 'users.id')
                    ->get();
                
            return $registro;
        }
        else {
            return null;
        }
    }

    public function classe () {

        return $this->belongsTo(Classe::class);

    }
}
