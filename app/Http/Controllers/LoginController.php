<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Models\Event;

class LoginController extends Controller
{

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Facebook callback
    public function handleFacebookCallback()
    {

        $userFacebook = Socialite::driver('facebook')->user();
        //dd($userFacebook);
        $user = User::where('facebook_id', $userFacebook->id)->first();
    
        if ($user) {
            $user->update([
                'facebook_token' => $userFacebook->token,
                'facebook_refresh_token' => $userFacebook->refreshToken,
            ]);
        } else {
            $user = User::create([
                'name' => $userFacebook->name,
                'email' => $userFacebook->email,
                'facebook_id' => $userFacebook->id,
                'facebook_token' => $userFacebook->token,
                'facebook_refresh_token' => $userFacebook->refreshToken,
            ]);
        }
 
        Auth::login($user);
 
        return redirect('/dashboard');

    }


}
