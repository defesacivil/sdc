<?php

namespace App\Http\Controllers\Usuario;


use App\Models\Usuario\Role;
use \App\Models\User as UserC;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;


class UserController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = UserC::with('roles')->get();  
        $roles = Role::with('users', 'permissions')->get();  


        return view(
            'config/usuario/user/index',
            [
                'users' => $users,
                'roles' => $roles,
            ]
        );
  
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


    

}
