<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->json('content');

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


    


}
