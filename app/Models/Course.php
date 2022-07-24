<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
        'active',
        'user_id',
        'duration',
        'created_at',
        'updated_at',
    ];
    use HasFactory;

    public static function buscar_cursos($search){

        if($search != null){

            $result = Course::where([['title', 'like', '%'.$search.'%']])->get();

            return $result;
        }
        else {
            return null;
        }
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
