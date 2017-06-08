<?php

namespace App\Providers;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\User;

class AuthschProvider extends AbstractProvider
{
    protected $scopes = [
        'basic',
        'displayName',
        'mail'
    ];

    protected $scopeSeparator = ' ';

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://auth.sch.bme.hu/site/login', $state);
    }

    protected function getTokenUrl()
    {
        return 'https://auth.sch.bme.hu/oauth2/token';
    }

    protected function getTokenFields($code)
    {
        return array_add(
            parent::getTokenFields($code), 'grant_type', 'authorization_code'
        );
    }

    protected function getUserByToken($token)
    {
        $userUrl = 'https://auth.sch.bme.hu/api/profile?access_token=' . $token;

        $response = $this->getHttpClient()->get($userUrl);

        $user = json_decode($response->getBody(), true);

        return $user;
    }

    protected function mapUserToObject(array $user)
    {
        // TODO: Implement mapUserToObject() method.

        $result = new User();

        $result->name = $user['displayName'];
        $result->email = $user['mail'];
        $result->provideUserId = $user['internal_id'];

        return $result;
    }
}