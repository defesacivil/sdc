<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {

        $uri = $request->getRequestUri();


        if($uri == "/pae.minieradora") {
            //return route('login');
            dd('opa');
        }elseif (! $request->expectsJson()) {
            //return redirect()->away(SDC);
       }
    }
}
