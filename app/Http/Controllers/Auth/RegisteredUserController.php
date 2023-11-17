<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cpf'      => ['required', 'numeric', 'digits:11'],
            
        ],
        [ 
            'name.required' => 'Campo obrigatório !',
            'name.string' => 'Só é permitido letras !',
            'name.max' => 'Máximo de 255 caracteres !',

            'email.required' => 'Campo obrigatório !',
            'email.string' => 'Só é permitido letras !',
            'email.max' => 'Máximo de 255 caracteres !',
            'email.unique' => 'Usuário já Existente, recupere sua senha !',
            
            'cpf.required' => 'Campo obrigatório !',
            'cpf.numeric' => 'Só é permitido números !',
            'cpf.digits' => 'Máximo de 11 caracteres !',            
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => Hash::make($request->password),
            'ativo' => 0,
        ]);

        return redirect('login')->with('message', 'Usuário cadastrado !');

        //event(new Registered($user));

        //Auth::login($user);

        //return redirect(RouteServiceProvider::INIT)->with('message', 'Usuario Cadastrado com Sucesso ! \n se tudo estiver correto você receberá um email de confirmação !');
    }
}
