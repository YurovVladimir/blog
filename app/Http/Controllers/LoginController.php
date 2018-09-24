<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * @param $provider
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $localUser = User::where('email', $user->getEmail())->first();
        if (!$localUser) {
            $localUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => \Hash::make($user->getName())
            ]);
        }
        \Auth::login($localUser);
        return redirect()->intended('/');
    }
}
