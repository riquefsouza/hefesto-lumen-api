<?php
namespace App\Http\Middleware;

use App\Models\User;
use App\Models\AdmUser;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Authenticator
{
    public function handle(Request $request, \Closure $next)
    {
        try {
            if (!$request->hasHeader('Authorization')) {
                throw new \Exception();
            }
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);

            $username = $credentials->username;
            $admUser = AdmUser::where('usu_login', $username)->first();
            $user = new User();
            $user->setIdAttribute($admUser->getIdAttribute());
            $user->setUsernameAttribute($admUser->getLoginAttribute());
            //$user->setPasswordAttribute($admUser->getPasswordAttribute());

            if (is_null($user)) {
                throw new \Exception();
            }

            return $next($request);
        } catch (\Exception $e) {
            return response()->json('Not authorized', Response::HTTP_UNAUTHORIZED);
        }
    }
}
