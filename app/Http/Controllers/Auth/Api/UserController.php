<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Models\Cedec\CedecUsuario;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{

    public function ListAll(Request $request)
    {

        $user = User::all()->where('tipo', '=', 'cedec')->toArray();

        return response()->json([
            'data' => array_values($user),
            JSON_FORCE_OBJECT,

        ]);
    }


    public function ListCompdec(Request $request)
    {

        $user = User::all()->where('tipo', '=', 'compdec')->toArray();

        return response()->json([
            'data_compdec' => array_values($user),
            JSON_FORCE_OBJECT,

        ]);

    }

        public function updatecpf(Request $request){

        $dados = $request;

        $user = User::where('id_user_cedec', '=', $request['id_usuario']);

    }


    /**
     *  Atualização email e cpf do usuário
     */ 
    public function update(Request $request)
    {
        $dados = $request['content'];
        //dd($dados);
                
        $user = User::where('id_user_cedec', "=", $dados['id_user_cedec'])->first();

        $user->email = $dados['email'];
        $user->ativo = $dados['ativo'];
        $user->cpf = $dados['cpf'];


        try {
            $result = $user->save();
        }catch (Exception $e) {

            $result = (str_contains($e->getMessage(), "Duplicate")) ? "duplicado" : "false";
        }

        return response()->json([
            'result' => $result,
        ]);

    }
}
