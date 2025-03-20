<?php

namespace App\Services;

use Illuminate\Http\Request;
use Laravel\Passport\Client;

class AuthService
{
    public function login($email, $password): string
    {
        $client = Client::all()[0];

        $clientId = $client->id;
        $clientSecret = $client->secret;
        $params = [
            'grant_type' => 'password',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'username' => $email,
            'password' => $password,
            'scope' => '',
        ];
        $routeOauth = route('passport.token');
        $tokenRequest = Request::create(
            $routeOauth,
            'POST',
            $params
        );
        $response = app()->handle($tokenRequest);

        return $response->getContent();
    }
}
