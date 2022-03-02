<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginGoogleController extends Controller
{
    public function login(){
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle() {
        $user = Socialite::driver('google')->user();
        //dd($user);
        $userExists = User::where('external_id', $user->id)->where('external_auth','google')->first();
        $emailExists= User::where('email', $user->email)->where('external_auth','')->first();

        if($userExists){
            Auth::login($userExists);
        }else{
            $newUser = User::updateOrCreate([
                            'name'          =>  $user->name,
                            'email'         =>  $user->email,
                            'avatar'        =>  $user->avatar,
                            'external_id'   =>  $user->id,
                            'external_auth' =>  'google',
                        ]);

            Auth::login($newUser);
        }
       return redirect('/dashboard');
    }
}
