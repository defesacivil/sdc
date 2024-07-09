<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;


use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cedec\CedecFuncionario;
use App\Models\Cedec\CedecUsuario;
use App\Models\Compdec\Compdec;
use App\Models\Municipio\Municipio;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        //dd(auth()->user(), $request);
        //return redirect()->away('http://sistema.defesacivil.mg.gov.br/index.php');
        return view('auth.login');
        //die();


    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {

       // return redirect()->away('http://sistema.defesacivil.mg.gov.br/index.php');
        
        $usuario = Auth::user();
        
        # usuario ativo
        if(Auth::check() && $usuario['ativo'] == 1){

            
            // tratar usuario compdec
            if($usuario['tipo'] == 'compdec'){
                
                if($usuario['municipio_id'] == 0){
                    
                    Log::channel('usuario')->info('Login de usuario sem Liberação Principal', ['table' => 'users', 'id_usuario' => Auth::user()->id]);
                    $this->destroy($request);
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
                
                    $request->session()->regenerate();
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
   

        // autenticação mineradora
        }else if(auth()->attempt($request->only(['cpf', 'password']))) {


            if(auth()->user()->tipo == 'externo') {
                
                return redirect('pae/mineradora');
            }else {
                //dd(auth()->user());
                return redirect()->intended(RouteServiceProvider::HOME);
            }
            

        }else {


            //redirect()->intended(RouteServiceProvider::HOME);

            //dd(auth()->attempt($request->only(['cpf', 'password'])));

            Log::channel('usuario')->info('Login de usuario Desativado', ['table' => 'users', 'id_usuario' => Auth::user()->id]);
            //$this->destroy($request);
            //Session::flash('message', "Usuário não está ativo ! \n Gentileza aguardar a ativação ou envie um email para sdc@defesacivil.mg.gov.br");
            return redirect(route('login'));
        }

        
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Log::channel('login')->info('Logout: '.Auth::user()->id);
        Auth::guard('web')->logout();

        $routeInicio = session()->get('routeInicio');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        //return redirect('/');
        return redirect()->away('http://sistema.defesacivil.mg.gov.br/index.php?token='.md5('123').'&'.$routeInicio);

    }
}
