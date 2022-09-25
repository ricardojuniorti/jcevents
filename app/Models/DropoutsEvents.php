<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropoutsEvents extends Model
{
    protected $table = 'dropouts_events';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'users_id',
        'events_id',
        'origin',
        'created_at',
        'updated_at',
    ];
    use HasFactory;
}
