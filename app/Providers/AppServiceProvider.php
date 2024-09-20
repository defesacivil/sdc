<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Public folder name changed with public_html
        $this->app->bind('path.public', function () {
            return base_path() . '/public';
        }); 

        Log::setTimezone(new \DateTimeZone('America/Sao_Paulo'));

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Scramble::routes(function (Route $route) {
            return Str::startsWith($route->uri, 'api/pub');
        });
        //
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();


        Sanctum::getAccessTokenFromRequestUsing(
            function ($request) {
                return $request->token;
            }
        );

        Sanctum::authenticateAccessTokensUsing(
            static function (PersonalAccessToken $accessToken, bool $is_valid) {
                if (!$accessToken->can('read:once')) {
                    return $is_valid; // We keep the current validation.
                } else {
                    //return dd('opa');
                }
            }
        );

        Sanctum::authenticateAccessTokensUsing(
            function (PersonalAccessToken $accessToken) {
                //dd($accessToken);
            }

        );
    }
}
