<?php

namespace App\Http\Controllers\Usuario;

use App\Models\Usuario\Permission;
use App\Models\Usuario\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleDemController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $request = request();
        if($request)
        return view('config/usuario/role/index', [
                    'perfis' => DB::table('roles')->paginate(5)
                ]);
    }

    /**
     * LISTA DE PERMISSOES DO USUARIO
     *
     * @return \Illuminate\Http\Response
     */
    public function index1($id)
    {
        $role = Role::find($id);

        $permissions = Role::with('permissions')->where('id', $id)->get();
        $permissions_all = Permission::pluck('name', 'id');

        $permissions_role = array();

        foreach ($permissions as $key => $permission) {
            foreach ($permission->permissions as $key => $perm) {
                $permissions_role[] = $perm;
            }
        }

        return view('config/usuario/permissao_role/index', [
                    'role' => $role,
                    'permissions_role' => $permissions_role,
                    'permissions_all' => $permissions_all,
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('config/usuario/role/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20',
            'label' => 'required|max:100',
        ],
        [ 
            'name.required'  => 'O Campo NOME é de preenchimento Obrigatório !',
            'label.required'  => 'O Campo LABEL é de preenchimento Obrigatório !',
            'name.max'    => 'O tamanho máximo para este campo é 20 Caracteres !',
            'label.max'    => 'O tamanho máximo para este campo é 100 Caracteres !',
            
        ]);

        $role = Role::create($request->all());
        return redirect('config/role/create')->with('message', 'Registro Gravado Com Sucesso');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addpermission(Request $request)
    {

        $request->validate([
            'permissions' => 'required',
        ],
        [ 
            'required'  => 'Gentileza escolher uma opção de Permissãoo !'  
        ]);

        $role = Role::find($request->role_id);

        $role->permissions()->attach($request->permissions);
        
        return redirect('role/'.$request->role_id)->with('message', 'Registro Gravado Com Sucesso');
    }

    /**
     * remover permissao do Perfil
     *
     * @param 
     * @return void
     */
    public function removepermission($role_id)
    {

        $permission = Permission::findOrFail($role_id);
        $permission->roles()->detach();
        return redirect()->back()->with('message','Registro deletado com Sucesso');
        
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perfil = Role::find($id);

        return view('config/usuario/role/show',
            [
                'perfil' => $perfil,
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
        
        $perfil = Role::find($id);

        return view('config/usuario/role/edit',
            [
                'perfil' => $perfil,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:20',
            'label' => 'required|max:100',
        ],
        [ 
            'required'  => 'Campo de preenchimento Obrigatório !',
            'name.max'    => 'O tamanho máximo para este campo é 20 Caracteres !',
            'label.max'    => 'O tamanho máximo para este campo é 100 Caracteres !',
            
        ]);

        $role = Role::find($id);
        
        $role->name = $request->input('name');
        $role->label = $request->input('label');
        
        $role->update();
        return redirect('config/usuario/role/index')->with('message','Registro Atualizado com Sucesso ');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect('role')->with('message','Registro deletado com Sucesso');
        
    }

    public function adduser($user_id){

        $user = User::find($user_id);
        $roles = Role::pluck('name', 'id');
        


        return view('config/usuario/role/role_add_user',
            [
                'user' => $user,
                'roles' => $roles,
            ]);

    }
}
