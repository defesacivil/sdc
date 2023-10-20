<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\UserController;
use App\Models\Cedec\CedecUsuario;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        

        # servidorI online
        if($_SERVER['HTTP_HOST'] != "localhost:8081") {
            $credentials = $request->json('content');
        }else {
            #localhost insomnia
            $credentials = $request;
        }     

        $tipo = null;

        # REDEC
        if($credentials['us'] ==  strtolower("redec")) {
             $tipo = 'redec';

        # COMPDEC
        }elseif($credentials['us'] == "null"){
             $tipo = 'compdec';

        # CEDEC
        }elseif($credentials['us'] == strtolower("cedec")){
             $tipo = 'cedec';
        }

        /* busca cpf nulo*/
        $cpf = User::where('id_user_cedec', $credentials['id_usuario'])
        ->where('cpf', null)
        ->where('tipo', $tipo)->count();

        if ($cpf == 1) {

            try{
            # verifica o id e atualiza o cpf
           User::where('id_user_cedec', $credentials['id_usuario'])
                            ->where('email', $credentials['email'])
                            ->update(['cpf' => $credentials['cpf']]);

            }catch(Exception $e) {
                if( preg_match('/Duplicate/', $e->getMessage()) ) {

                    print "<div class='col-md-12 text-center'><br><br>";
                    print "<span class='alert alert-danger p-3'>CPF já utilizado no Sistema \n Contate o Administrador \n sdc@defesacivil.mg.gov.br</span>";
                    print "<br><br><br><br><a class='btn btn-success' href='".url('dashboard')."'>Voltar</a>";
                    print "</div>";
                }
            }
        }

            if (!auth()->attempt(['cpf'=> $credentials['cpf'], 'password'=> $credentials['password']]) ) {
                
                #enviar email
                $dadossdc = [
                    'dados' => $credentials   
                ];

                $dadoslara = [
                    'id_cedec_user' =>'',
                    'email' => '',
                    'password' =>'',
                    'cpf' => '',
                    'login' => '',

                ]
                return response()->json([
                    'result' => 'Nao Autorizado',


                    //abort(401, 'Credendiais Inválidas')
                ]);
            } else {

                //dd($token = auth()->user()->token());
                //dd(auth()->getAccessToken());
                $token = auth()->user()->createToken(
                        'teste',
                        ['*'],
                        Carbon::now()->addHours(24));

                //$token = PersonalAccessToken::findToken($token);

                //dd($token);
            }

            return response()->json([
                'token' => $token,
                'result' => true,
                
            ]);
        
    }


    /* */
    public function update($val)
    {

        $user = "";
    }
}
