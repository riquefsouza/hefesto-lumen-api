<?php

namespace App\Http\Controllers;

use App\Models\AdmUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AdmUserService;
use Firebase\JWT\JWT;
use App\Base\Models\TokenDTO;
use App\Base\Models\LoginForm;

class LoginController extends Controller
{

    /**
     * @var AdmUserService
     */
    private $service;

    public function __construct(AdmUserService $service)
    {
        $this->service = $service;
    }

    public function login(Request $request)
    {
        $loginForm = new LoginForm($request->all());

        if (!is_null($loginForm->getLogin()) && !is_null($loginForm->getPassword()))
        {
            $user = $this->service->authenticate($loginForm->getLogin(), $loginForm->getPassword());

            if (!is_null($user))
            {
                //create claims details based on the user information
                $token = JWT::encode([
                    'username' => $user->getLoginAttribute(),
                    'id' => strval($user->getIdAttribute()),
                    'name' => $user->getNameAttribute(),
                    'email' => $user->getEmailAttribute()
                ], '%env(string:JWT_SECRET)%', 'HS256');

                $tokenDTO = new TokenDTO($token, "Bearer");

                return response()->json($tokenDTO);
            } else {
                return response()->json(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
            }
        } else {
            return response()->json(['error' => 'Send login and password'], Response::HTTP_BAD_REQUEST);
        }

    }
}
