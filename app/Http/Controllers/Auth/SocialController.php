<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{

    public function authorize($provider)
    {
        return Socialite::with($provider)->redirect();
    }

    public function login($provider, Request $request)
    {
        $social = Socialite::with($provider)->user();
        $user = User::findEmail($social->getEmail());
        if (empty($user)) {
            $password = Str::random(8);
            $user = User::create([
                'email' => $social->getEmail(),
                'display_name' => $social->getName(),
                'password' => $password
            ]);

            //Avatar::sync($user->id, $social->getAvatar());
        }

        if (empty($user->social[$provider])) {
            $user->social = Arr::add($user->social, $provider, $social->getId());
        }

        $user->save();

        $this->guard()->login($user);

        return $this->assetView('social', 'auth', ['success'=>true]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
