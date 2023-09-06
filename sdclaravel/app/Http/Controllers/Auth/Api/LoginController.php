<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {


        dd($request);
        //$credentials = $request->only('cpf', 'password');
        //return dd($request->json('content'));
        //$credentials = $request->only('cpf', 'password');
        $credentials = $request->json('content');
        //$credentials['password'] = bcrypt($credentials['password']);

        if (!auth()->attempt($credentials)) {
            abort(401, 'Credendiais Inválidas');
        } else {

            $token = auth()->user()->createToken('teste');
            //dd($token);
            
        }

        return response()->json([
            'data' => [
                'token' => $token,
                'result' => true,
                
            ]
        ]);
    }


}
