<?php

namespace App\Http\Controllers\Usuario;

use App\Models\Usuario\Permission;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissoes = Permission::all();
        return view('/config/usuario/permissao/index',
                        ['permissoes' => $permissoes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/config/usuario/permissao/create');
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
            'required'  => 'Campo de preenchimento Obrigatório !',
            'name.max'    => 'O tamanho máximo para este campo é 20 Caracteres !',
            'label.max'    => 'O tamanho máximo para este campo é 100 Caracteres !',
            
        ]);
        $role = Permission::create($request->all());
        return redirect('config/permissao/create')->with('message', 'Registro Gravado Com Sucesso');
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

        return view('config/usuario/permissao/edit',
            [
                'permission' => $permissao,
            ]);
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
        $request->validate([
            'name' => 'required|max:20',
            'label' => 'required|max:100',
        ],
        [ 
            'required'  => 'Campo de preenchimento Obrigatório !',
            'name.max'    => 'O tamanho máximo para este campo é 20 Caracteres !',
            'label.max'    => 'O tamanho máximo para este campo é 100 Caracteres !',
            
        ]);

        $permissao = Permission::find($id);
        
        $permissao->name = $request->input('name');
        $permissao->label = $request->input('label');
        
        $permissao->update();
        return redirect()->back()->with('message','Registro Atualizado com Sucesso ');
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
        return redirect('config/permissao')->with('message','Registro deletado com Sucesso');
    }
}
