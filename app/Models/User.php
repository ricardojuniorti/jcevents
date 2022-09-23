<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $table = 'users';

    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'user_profile_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public static function buscar_dados() {

        $registro = DB::table('users')
                ->select('users.id as id','users.name as name','users.email as email','users.phone as phone','users.created_at as created_at','users.updated_at as updated_at','user_profile.description as description')
                ->orderByRaw('users.name ASC')
                ->Join('user_profile', 'users.user_profile_id', '=', 'user_profile.id')
                ->get();
    
        return $registro;

    }

    public function buscar_dados_por_id($id = null) {

        if($id != null){

            $registro = DB::table('users')
                    ->where('users.id', $id)
                    ->select('users.id as id','users.name as name','users.email as email','users.phone as phone','users.created_at as created_at','users.updated_at as updated_at','user_profile.description as description')
                    ->orderByRaw('users.name ASC')
                    ->Join('user_profile', 'users.user_profile_id', '=', 'user_profile.id')
                    ->get();
                
            return $registro;
        }
        else {
            return null;
        }
    }


    public function events() {
        return $this->hasMany('App\Models\Event');
    }

    public function eventsAsParticipant() {
        return $this->belongsToMany('App\Models\Event');
    }

    public function courses() {
        return $this->hasMany(Course::class);
    }

    public function coursesAsParticipant() {
        return $this->belongsToMany(Course::class);
    }

}