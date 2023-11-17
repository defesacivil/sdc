<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
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
