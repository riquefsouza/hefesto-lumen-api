<?php

namespace App\Providers;

use App\Models\User;
use App\Models\AdmUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Firebase\JWT\JWT;
use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
/*
        $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->input('api_token')) {
                return User::where('api_token', $request->input('api_token'))->first();
            }
        });
*/

        $this->app['auth']->viaRequest('/api/v1', function (Request $request) {
            if (!$request->hasHeader('Authorization')) {
                return null;
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
            return $user;

        });


    }
}
