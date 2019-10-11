<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Log;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        $socialiteUser = Socialite::driver($social)->user();
        $user = SocialAccountService::createOrGetUser($socialiteUser, $social);
        auth()->login($user);

        return redirect()->to('/home');
    }
}