<?php

namespace App\Http\Controllers\Usuario;

use App\Models\User;
use App\Models\Usuario\PermissionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionUserController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissoes = Permission::all();
        return view(
            '/config/usuario/permissao/index',
            ['permissoes' => $permissoes]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $user = User::find($id);
        //dd($id);
        $permissions = collect(Permission::all());

        //dd($permissions);

        $permissions_user = collect();


        $model_has_permissions = DB::table('model_has_permissions')
            ->join('users', 'users.id', 'model_has_permissions.model_id')
            ->join('permissions', 'permissions.id', 'model_has_permissions.permission_id')
            ->select('model_has_permissions.*', 'users.name as user', 'users.tipo', 'permissions.*')
            ->where('users.id', '=', $user->id)
            ->get();

        foreach ($permissions as $key => $permission) {

            if ($model_has_permissions->contains('name', $permission['name'])) {
                $permissions_user->push(['permission_id' => $permission['id'], 'permission' => $permission['name'], 'user' => $user['name'], 'checked' => 'true']);
            } else {
                $permissions_user->push(['permission_id' => $permission['id'], 'permission' => $permission['name'], 'user' => $user['name'], 'checked' => 'false']);
            }
        }

        //$user->syncRoles($roles);

        //dd($permissions_user);
        return view('/config/usuario/permissao_user/create', [
            'user' => $user,
            'permissions' => $permissions,
            'permissions_user' => $permissions_user,

        ]);
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

        $permissions = array();

        foreach ($request->all() as $key => $value) {
            if(substr($key, 0, 10) == "permissao_") {
                $permissions[] = $value;
            }
        }

        //dd($permissions);

        $user->syncPermissions($permissions);

        return redirect('usuario/permission/add/'.$request->user_id)->with('message', 'Registro Gravado Com Sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $permissao = Permission::find($id);

        return view(
            'config/usuario/permissao/edit',
            [
                'permission' => $permissao,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|max:20',
                'label' => 'required|max:100',
            ],
            [
                'required'  => 'Campo de preenchimento Obrigatório !',
                'name.max'    => 'O tamanho máximo para este campo é 20 Caracteres !',
                'label.max'    => 'O tamanho máximo para este campo é 100 Caracteres !',

            ]
        );

        $permissao = Permission::find($id);

        $permissao->name = $request->input('name');
        $permissao->label = $request->input('label');

        $permissao->update();
        return redirect()->back()->with('message', 'Registro Atualizado com Sucesso ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permissao = Permission::find($id);
        $permissao->delete();
        return redirect('config/permissao')->with('message', 'Registro deletado com Sucesso');
    }
}
