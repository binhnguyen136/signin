<?php

namespace App\Services;

use Laravel\Socialite\Contracts\User as ProviderUser;
use App\SocialAccount;
use App\User;
use Illuminate\Support\Facades\Hash;

class SocialAccountService
{
    public static function createOrGetUser(ProviderUser $providerUser, $social)
    {
        $email = $providerUser->getEmail() ?? $providerUser->getNickname();
        $user = User::whereProvider($social)->whereProviderId($providerUser->getId())->orWhere('email', $email)->first();

        if (!$user) {
            $user = User::create([
                'provider' => $social,
                'provider_id' => $providerUser->getId(),
                'email' => $providerUser->getEmail() ? $providerUser->getEmail() : $providerUser->getId().'@'.$social.'.com',
                'password' => Hash::make('12345678'),
                'name' => $providerUser->getName()
            ]);
        }

        return $user;
    }
}