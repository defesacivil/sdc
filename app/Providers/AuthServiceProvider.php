<?php

namespace App\Providers;

use App\Models\Cedec\CedecFuncionario;
use App\Models\Cedec\CedecUsuario;
use App\Models\Compdec\Compdec;
use App\Models\Municipio\Municipio;
use App\Models\Permission;
use App\Models\User;
use App\Models\Usuario\PermissionRole;
use App\Models\Usuario\RoleDem;
use App\Models\Usuario\RoleUser;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\PersonalAccessToken;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    // public function boot(Request $request)
    public function boot(Request $request)
    {
   

        if ($autor = PersonalAccessToken::findToken($request->token)) {
            $usuario = auth()->loginUsingId($autor->tokenable_id);  
            auth()->user()->tokens()->delete();  

            

            # usuario ativo
        if(Auth::check() && $usuario['ativo'] == 1){

          
            // tratar usuario compdec redec
            if( ($usuario['tipo'] == 'compdec') ) {

                # usuario sem liberações
                if($usuario['municipio_id'] == 0){
                    
                    
                    $usuario->Auth::logout();
                    Session::flash('message', "Usuário não associado ! é necessário realizar a associação de usuario no sistema, envie um email para sdc@defesacivil.mg.gov.br !");
                    return redirect('/');
                # registro login usuario
                }else {

                    # registro login de usuario
                    Log::channel('login')->info("usuario : ".Auth::user()->id) ;

                    $compdec = Compdec::where('id_municipio', $usuario['municipio_id'])
                        ->get('id');
                    
                    # Dados Sessao
                    $dadosSession = [
                        'municipio_id' => $usuario['municipio_id'],
                        'municipio' => Municipio::find($usuario['municipio_id'])->nome,
                        'compdec_id' => $compdec[0]['id'],
                    ];
                
                    //$request->session()->regenerate();
                    Session()->put('user', $dadosSession);
                    return redirect()->intended(RouteServiceProvider::HOME);

                }
            
            # CEDEC / REDEC
            }elseif ($usuario['tipo'] == 'cedec'){

                # registro login de usuario
                Log::channel('login')->info("acesso : ".Auth::user()->id) ;

                $cedecUsuario = CedecUsuario::find($usuario['id_user_cedec']);
   
                //$cedecFuncionario = CedecFuncionario::find($cedecUsuario['id_funcionario'])->toArray();
                $cedecFuncionario = 'secao';
                
                # Dados Sessao
                $dadosSession = [
                                    'admin' => $usuario['ativo'],
                                    //'usuario' => $cedecUsuario,
                                    'usuario' => Auth::user()->name,
                                    'funcionario' => $cedecFuncionario,
                                ];
                                
                Session()->regenerate();
                Session()->put('user', $dadosSession);
                return redirect()->intended(RouteServiceProvider::HOME);
            }
   
        # usuario desativado
        }else {

            Log::channel('navegacao')->info('Login de usuario Desativado', ['table' => 'users', 'id_usuario' => Auth::user()->id]);
            $usuario->Auth::logout();
            Session::flash('message', "Usuário não está ativo ! \n Gentileza aguardar a ativação ou envie um email para sdc@defesacivil.mg.gov.br");
            //return redirect('/');
        }
            
            # adicionar rota para voltar no sdc 
            $sdc = 'sistema.defesacivil.mg.gov.br';

                Session()->put('routeInicio', $request->routeInicio.'&controller='.$request->controller.'&action='.$request->action);

                
        }


        /* REESCREVER GATE */
        Gate::define('mah', function (User $user, $municipio_id) {

            if (
                ($user->tipo === 'compdec') &&
                (Session::get('user')['municipio_id'] == $municipio_id) ||
                $user->tipo === 'cedec'
            ) {
                return true;
            } else {
                print "<p class='alert alert-danger'>Prezado Usuário, <br> Voçe esta tentando acessar um PROCESSO/DOCUMENTO que não faz parte do seu município
                gentileza verifique o click clicado.</p>";
            }
        });

        $this->registerPolicies();

    }
}
