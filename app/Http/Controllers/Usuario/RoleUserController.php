<?php

namespace App\Http\Controllers\Usuario;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleUserController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $model_has_roles = DB::table('model_has_roles')
            ->join('users', 'users.id', 'model_id')
            ->join('roles', 'roles.id', 'model_id')
            ->select('model_has_roles.*', 'users.name as name', 'roles.name as role')
            ->paginate(5);

        return view('config/usuario/role_user/index', [
            'model_has_roles' => $model_has_roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $roles = collect(Role::all());

        $user_posicao = collect();
        $user = User::find($id);

        $model_has_roles = DB::table('model_has_roles')
            ->join('users', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', 'model_has_roles.role_id')
            ->select('model_has_roles.*', 'users.name as user', 'users.tipo', 'roles.*')
            ->where('users.id', '=', $user->id)
            ->get();

        foreach ($roles as $key => $role) {

            if ($model_has_roles->contains('name', $role['name'])) {
                $user_posicao->push(['role_id' => $role['id'], 'role' => $role['name'], 'user'=> $user['name'], 'checked'=> 'true']);
            } else {
                $user_posicao->push(['role_id' => $role['id'], 'role' => $role['name'], 'user' => $user['name'], 'checked' => 'false']);
            }
        }


        //dd($user_posicao, $user);
        return view(
            'config/usuario/role_user/create',
            [
                'roles' => $user_posicao,
                'users' => $user,
            ]
        );
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

        $roles = array();

        foreach ($request->all() as $key => $value) {
            if(substr($key, 0, 5) == "role_") {
                $roles[] = $value;
            }
        }

        $user->syncRoles($roles);
        
        // if($request->checked == 'true') {
        //     $user->assignRole($request->role);
        // }else {
        //     $user->removeRole($request->role);
        // }

        //$user->ativo = $request->ativo;
        //dd($user->update());

        return redirect('usuario/role/add/' . $request->user_id)->with('message', 'Registro Gravado Com Sucesso');

        // return response()->json([
        //     'view' => '/usuario/role/add/' . $request->user_id,
        //     'message' => 'Registro Gravado com Sucesso',
        //     'tipo' => 'success',
        //     'status' => true
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return \Illuminate\Http\Response
     */
    public function show(Role $roleUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $roleUser)
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
    public function update(Request $request, Role $roleUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $roleUser)
    {
        dd($roleUser);
        $user = User::find($roleUser->user_id);
        $user->roles()->detach($roleUser->role_id);
    }
}
