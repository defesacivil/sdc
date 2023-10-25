<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Models\Cedec\CedecUsuario;
use App\Models\User;
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

<<<<<<< HEAD

    public function ListCompdec(Request $request)
    {

        $user = User::all()->where('tipo', '=', 'compdec')->toArray();

        return response()->json([
            'data_compdec' => array_values($user),
            JSON_FORCE_OBJECT,

        ]);
=======
    public function updatecpf(Request $request){

        $dados = $request;

        $user = User::where('id_user_cedec', '=', $request['id_usuario']);

>>>>>>> bf734878a76002c4b69be49a8889f0c1ee91d54d
    }
}
