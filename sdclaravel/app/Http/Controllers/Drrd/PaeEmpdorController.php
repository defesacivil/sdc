<?php

namespace App\Http\Controllers\Drrd;


use App\Models\Drrd\PaeEmpdor;
use Illuminate\Http\Request;


class PaeEmpdorController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->method() == "GET") {

            $empdors = PaeEmpdor::paginate(7);

            return view(
                'drrd/paebm/empdor/index',
                [
                    'empdors' => $empdors,
                ]
            );
        } elseif($request->method() == "POST") {

            $empdors = PaeEmpdor::where('pae_empdors.nome', 'LIKE', '%' . $request->get('search') . '%')
                ->paginate();

                return view(
                    'drrd/paebm/empdor/index',
                    [
                        'empdors' => $empdors,
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
        return view('drrd/paebm/empdor/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nome'               => "required|max:110",
            ],
            [        
                'nome.required' => 'O campo  Nome é Obrigatório !',
                'nome.max' => 'O campo Nome suporta no máximo 110 caracteres !',
            ]
        );


        $empnto = new PaeEmpdor;
        $empnto->nome               = $request->nome;

        $empnto->save();
    
        return redirect('pae/empdor')->with('message','Registro Gravado com Sucesso ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drrd\PaeEmpdor  $paeEmpdor
     * @return \Illuminate\Http\Response
     */
    public function show(PaeEmpdor $paeEmpdor)
    {
        return view(
            'drrd/paebm/empdor/show',
            [
                'empdor' => $paeEmpdor,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drrd\PaeEmpdor  $paeEmpdor
     * @return \Illuminate\Http\Response
     */
    public function edit(PaeEmpdor $paeEmpdor)
    {

        return view(
            'drrd/paebm/empdor/edit',
            [
                'empdor' => $paeEmpdor,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drrd\PaeEmpdor  $paeEmpdor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaeEmpdor $paeEmpdor)
    {
        $request->validate(
            [
                'id'                 => "required|integer",
                'nome'               => "required|max:110",
            ],
            [
                'id.required' => 'O campo Id não está presente',
                'nome.required' => 'O campo Nome é Obrigatório !',
                'nome.max' => 'O campo Nome suporta no máximo 110 caracteres !',
            ]
        );

        $empnto = PaeEmpdor::find($request->id);
        $empnto->nome               = $request->nome;

        $empnto->update();
                
        return redirect('pae/empdor')->with('message','Registro Atualizado com Sucesso ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drrd\PaeEmpdor  $paeEmpdor
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaeEmpdor $paeEmpdor)
    {
        //
    }


    /* Exportar dados para Planilha Excel */
    public function export(){
        //return Excel::download(new PaeEmpdor, 'users.xlsx');
    }
}
