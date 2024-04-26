<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {

        //dd(Auth::user());
        if (Auth::attempt(['cpf' => $cpf, 'password' => $password, 'ativo'=> 1]))
        {
            return redirect()->intended('dashboard');
        }
    }

    
}