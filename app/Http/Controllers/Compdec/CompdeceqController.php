<?php

namespace App\Http\Controllers\Compdec;

use App\Http\Controllers\Controller;
use App\Models\Compdec\CompdecEquipe;
use Illuminate\Http\Request;

class CompdeceqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // via modal
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $equipe = new CompdecEquipe;

        
        $equipe->nome = $request->nome;
        $equipe->id_municipio = $request->id_municipio;
        $equipe->funcao = $request->funcao;
        $equipe->telefone = $request->telefone;
        $equipe->celular = $request->celular;
        $equipe->email = $request->email;
        $equipe->id_compdec = $request->id;

        if($equipe->save()){
            return back()
            ->with(['success' =>'Cadastro de Membro Realizado com Sucesso !',
                    'active_tab' => '#-equipe-tab']);
        }
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
        $equipe = CompdecEquipe::find($id);
        dd($equipe);
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
        $equipe = CompdecEquipe::find($id);

	    return response()->json([
	      'data' => $equipe
	    ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = CompdecEquipe::find($id)->delete();

        if($delete){
            return back()
                ->with([
                        'message' => 'Registro deletado com Sucesso !',
                        'active_tab' => '#-equipe-tab',
                        ]);
        }

    }
}
