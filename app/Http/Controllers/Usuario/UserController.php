<?php

namespace App\Http\Controllers\Usuario;

use \App\Models\User as UserC;
use \App\Models\Sdc\User as UserSdc;
use \App\Models\Sdc\Funcionario as FuncionarioSdc;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;

class UserController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->method() == 'GET') {

            return view(
                'config/usuario/user/index'
            );
        } elseif ($request->method() == 'POST') {

            $users = UserC::with('roles',  'permissions')
                ->where('name', 'like', '%' . $request->get('search') . '%')
                ->get();

            //dd($users->roles());

            ///dd($user->hasAllRoles('cedec'));

            // $users = UserC::with('roles', 'permissions')
            // ->where('users.name', 'like', '%'.$request->get('search').'%')
            // ->get();

            // $roles = Role::with('users', 'permissions')
            //         ->where('roles.users.name', 'like', '%'.$request->get('search').'%')
            //             ->get();

            return view(
                'config/usuario/user/index',
                [
                    'users' => $users,
                ]
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('usuarioperfil/show', [
            'usuarioperfil' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuarioPerfil = User::find($id);

        return view('config/usuario/usuarioperfil/edit', [
            'usuarioperfil' => $usuarioPerfil
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $input = $request->except('_token');

        $user = User::find($input['id']);

        $user->fill($input);

        $user->save();

        return back()->with('message', 'Registro Atualizado com Sucesso !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /* Empreendimento Autocomplete */
    public function user_autocomplete(Request $request)
    {
        $data = User::select("user.name as value")
            ->where('user.name', 'LIKE', '%' . $request->get('search') . '%')
            ->get();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createNewUser()
    {
        return view('config/usuario/user/newuser');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeNewUser(Request $request)
    {

        if($request->posto != 'FUNCIONARIO CIVIL'){

            $login = "S".$request->masp_numpol;
        }else {
            $login = "M".$request->masp_numpol;
        }

        dd($login);

        #cadastro USUARIO SDC antigo
        $userSDc = new UserSdc();
        $userSDc->nome = $request->name;
        $userSDc->id_deposito = 1;
        $userSDc->senha = md5("1a9686a9a911d36609e50c31e79d0e0e");
        $userSDc->cpf =  $request->cpf;
        $userSDc->email_rec =  $request->email;
        $userSDc->situacao = 1;
        $userSDc->login = $login;
        $userSDc->save();

        #cadastro FUNCIONARIO SDC antigo
        $funcSDC = new FuncionarioSDC();
        $funcSDC->nome = $request->name;
        $funcSDC->cpf = $request->cpf;
        $funcSDC->num_masp = $request->masp_numpol;
        $funcSDC->celular = $request->tel;
        $funcSDC->posto = $request->posto;
        $funcSDC->email = $request->email;
        $funcSDC->id_rpm = 1;
        $funcSDC->libera = 0;
        $funcSDC->orgao = "CEDEC";
        $funcSDC->secao = "STO";
        $funcSDC->funcao = "AUXILIAR I";
        $funcSDC->desc_funcao = "Auxiliar Administrativo";
        $funcSDC->dt_nasc = $request->dt_nasc;
        $funcSDC->save();


        # chamado Criar email
        //Mail::to($request->email)->send(new WelcomeMail('poá'));

        # criar sei



        # cadastro usuario no SDC novo
        $user = new User();
        Log::error($request);

        $user->name       = $request->name;
        $user->email      = $request->email;
        $user->cpf        = $request->cpf;
        $user->password   = '$2a$12$KrZRc7.nY.fFrrJy9TptOexgkAWyiDcg7oXMsTi9H/NdQjejyCTqC';
        $user->ativo = 1;
        $user->id_user_cedec = $funcSDC->id;
        $user->municipio_id = 1;
        $user->login = $login;
        $user->tipo = "cedec";
        $user->sub_tipo = "membro";
        $user->save();


        return redirect('usuario/novo')->with('message', 'Registro Gravado com Sucesso ');
    }
}
