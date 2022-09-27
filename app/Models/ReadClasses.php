<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReadClasses extends Model
{
    protected $table = 'read_classes';
    protected $fillable = [
        'id',
        'users_id',
        'classes_id',
        'reading',
        'created_at',
        'updated_at',
    ];

    use HasFactory;

    public static function buscar_lido($users_id = null,$classes_id = null) {

        if($users_id != null && $classes_id != null){

            $registro = DB::table('read_classes')
                    ->where('users_id', $users_id)
                    ->where('classes_id', $classes_id)
                    ->select('*')
                    ->first();
                
            return $registro;
        }
        else {
            return null;
        }
    }

    public static function atualizarAulaLida($users_id = null, $classes_id = null, $reading = null)
    {
        if ($users_id != null && $classes_id != null && $reading != null) {
            ReadClasses::where('users_id', $users_id)
                        ->where('classes_id', $classes_id)
                            ->update([
                                'reading' => $reading
                            ]);
        }
    }
}
