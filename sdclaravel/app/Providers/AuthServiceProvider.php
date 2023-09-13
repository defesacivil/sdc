<?php

namespace App\Providers;

use App\Models\Cedec\CedecFuncionario;
use App\Models\Cedec\CedecUsuario;
use App\Models\Compdec\Compdec;
use App\Models\Municipio\Municipio;
use App\Models\Permission;
use App\Models\User;
use App\Models\Usuario\PermissionRole;
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

        $credential = $request->token;

        if ($autor = PersonalAccessToken::findToken($request->token)) {
            $usuario = auth()->loginUsingId($autor->tokenable_id);

            # usuario ativo
        if(Auth::check() && $usuario['ativo'] == 1){

            
            // tratar usuario compdec
            if($usuario['tipo'] == 'compdec'){
                
                if($usuario['municipio_id'] == 0){
                    
                    Log::channel('usuario')->info('Login de usuario sem Liberação Principal', ['table' => 'users', 'id_usuario' => Auth::user()->id]);
                    $usuario->Auth::logout();
                    Session::flash('message', "Usuário não associado ! é necessário realizar a associação de usuario no sistema, envie um email para sdc@defesacivil.mg.gov.br !");
                    return redirect('/');
                }else {

                    Log::channel('usuario')->info('Login usuario COMPDEC', ['table' => 'users', 'id_usuario' => Auth::user()->id]);
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
            
            }
                
            // usuario cedec
            if($usuario['tipo'] == 'cedec'){

                Log::channel('usuario')->info('Login Usuário CEDEC', ['table' => 'users', 'id_usuario' => Auth::user()->id]);
                # Dados Cedec_usuario
                $cedecUsuario = CedecUsuario::find($usuario['id_user_cedec']);
                
                $cedecFuncionario = CedecFuncionario::find($cedecUsuario['id_funcionario']);
                
                # Dados Sessao
                $dadosSession = [
                                    'admin' => $usuario['ativo'],
                                    'usuario' => $cedecUsuario,
                                    'funcionario' => $cedecFuncionario,
                                ];
                                
                $request->session()->regenerate();
                Session()->put('user', $dadosSession);
                return redirect()->intended(RouteServiceProvider::HOME);
            }
   
        }else {

            Log::channel('usuario')->info('Login de usuario Desativado', ['table' => 'users', 'id_usuario' => Auth::user()->id]);
            $usuario->Auth::logout();
            Session::flash('message', "Usuário não está ativo ! \n Gentileza aguardar a ativação ou envie um email para sdc@defesacivil.mg.gov.br");
            //return redirect('/');
        }
            
            # adicionar rota para voltar no sdc 
            $sdc = 'sistema.defesacivil.mg.gov.br';
            Session()->put('routeInicio', $request->routeInicio.'&controller='.$request->controller.'&action='.$request->action);

        }
        $this->registerPolicies();

        /* ACESSO COMPDEC */
        Gate::define('compdec', function (User $user) {

            return $user->tipo === 'compdec';
        });

        // ACESSO CEDEC
        // Gate::define('cedec', function (User $user) {
        //     return $user->tipo === 'cedec';
        // });



        // permissoes 
        Gate::define('cedec', function (User $user) {

            if ($user->tipo === 'cedec') {

                //dd($user->id, RoleUser::find($user->id)->get());
                return true;
            } else {
                //     print "<script>$('img[name=^icon]').addClass('imgCinza')</script>";
                return false;
            }
        });

        // ENTRADA paebm 
        Gate::define('paebm', function (User $user) {

            foreach ($user->roles as $role) {
                foreach ($role->permissions as $permission) {
                    if ($permission->name == 'paebm') {
                        return true;
                    }
                }
            }
        });


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


        //$this->defineAdminGate();

        /*Auth::provider('customcs', function ($app, array $config) {
            return $app->make(CustomEloquentUserProvider::class, ['model' => $config['model']]);
        });*/


        /*$permissions = Permission::with('roles')->get();
        foreach ($permissions as $permission)
        {
            $gate->define($permission->name, function(User $user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }*/

        // $gate->before(function(User $user, $ability){
        //    return $user->hasAnyRoles('cedec');
        //  });

    }
}
