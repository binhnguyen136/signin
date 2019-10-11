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

        $userInfo = new \stdClass();
        $userInfo->name = $user->name;
        $userInfo->email = $user->email;
        $userInfo->phone = $user->phone ?? '';
        $userInfo->address = $user->address ?? '';

        return redirect()->to('/home')->with('userInfo', $userInfo);
    }
}