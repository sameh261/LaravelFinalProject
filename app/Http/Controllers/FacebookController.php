<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        if (is_null($facebookUser->email)) {
            return redirect()->route('register')->with('alert', 'Cant log with Facebook.');
        }


        $user = User::where('email', $facebookUser->email)->first();

        if (is_null($user)) {
            $user = User::create([
                'first_name' => $facebookUser->name,
                'last_name' => $facebookUser->name,
                'email' => $facebookUser->email,
                'avatar' => $facebookUser->avatar,
                'facebook_id' => $facebookUser->id,
                'password' => bcrypt('12345678'),
            ]);
        }

        Auth::login($user);

        return redirect()->route('home');
    }
}
