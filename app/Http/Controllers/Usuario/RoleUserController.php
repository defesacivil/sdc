<?php

namespace App\Http\Controllers\Usuario;

use App\Models\User;
use App\Models\Usuario\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleUserController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
        return view('config/usuario/role_user/index', [
            'role_users' => DB::table('role_users')->paginate(5)
        ]);
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
        $user = User::find($request->user_id);
        $user->roles()->attach($request->role_id);

        $user->ativo = $request->ativo;
        $user->update();

        return redirect('role_add_user/'.$request->user_id)->with('message', 'Registro Gravado Com Sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return \Illuminate\Http\Response
     */
    public function show(RoleUser $roleUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return \Illuminate\Http\Response
     */
    public function edit(RoleUser $roleUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoleUser  $roleUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoleUser $roleUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleUser $roleUser)
    {
        dd($roleUser);
        $user = User::find($roleUser->user_id);
        $user->roles()->detach($roleUser->role_id);
    }
}
