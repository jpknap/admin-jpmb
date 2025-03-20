<?php

namespace App\Projects\Gymrat\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        /** @var User $user */
        $user = $request->user();

        $client = Client::all()[0];

        $clientId = $client->id;
        $clientSecret = $client->secret;
        $params = [
            'grant_type'    => 'password',
            'client_id'     => $clientId,      // Valor obtenido para el tenant actual
            'client_secret' => $clientSecret,  // Valor obtenido para el tenant actual
            'username'      => $user->email,
            'password'      => $request->password,
            'scope'         => '',
        ];
        $routeOauth = route('passport.token');
        $tokenRequest = Request::create(
            $routeOauth,
            'POST',
            $params
        );

        $response = app()->handle($tokenRequest);
        return response()->json(json_decode((string) $response->getContent(), true));
    }
}
