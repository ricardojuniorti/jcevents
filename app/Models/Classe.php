<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = 'classes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'link_video',
        'active',
        'sequence',
        'course_id',
        'created_at',
        'updated_at',
    ];
    use HasFactory;

    public static function buscar_aulas($id = null) {

        if($id != null){

            $registro = DB::table('classes')
                    ->where('courses_id', $id)
                    ->orderByRaw('title ASC')
                    ->get();
        
            return $registro;

        }

        else{
            return null;
        }

    }

    public function message_classes () {

        return $this->hasMany(MessageClasses::class);

    }

    public function user () {

        return $this->hasMany(User::class);

    }
}
