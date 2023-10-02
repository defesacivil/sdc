<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        # servidor online
        //$credentials = $request->json('content');

        #localhost
        $credentials = $request->only('cpf', 'password');

        if (!auth()->attempt($credentials)) {
            abort(401, 'Credendiais Inválidas');
        } else {
            $token = auth()->user()->createToken('teste');
        }

        return response()->json([
            'token' => $token,
            'result' => true,
        ]);
    }


    /* */
    public function update($val) {

        $user = "";

    }
}
