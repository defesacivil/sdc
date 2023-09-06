<?php

namespace App\Http\Controllers\Compdec;

use App\Models\Compdec\CompdecAnexo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;



class CompdecAnexoController extends \App\Http\Controllers\Controller
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
        
        $request->validate([
            'arquivo' => 'required|mimes:pdf,doc,docx,odt|max:2000',
            'descricao' => 'required|max:110',
            'id_municipio' => 'required|integer',
        ],
        [ 
            'arquivo.required' => 'É obrigatório anexar um arquivo !',
            'mimes' => 'Tipo de Arquivos permitidos : PDF, DOC, DOCX, ODT',
            'arquivo.max'    => 'Arquivo muito grande, Tamanho Máximo permitido : 2Mb ou 2000kb',
            'descricao.required'  => 'O Campo Descrição é Obrigatório !',
            'descricao.max'  => 'O tamanho máximo do Campo é de 110 Caracteres !',
            'id_municipio.required' => 'Aconteceu um erro interno !, Contate o Administrador',
        ]);

        $fileName = $request->id."-".time().'.'.$request->file('arquivo')->extension();

        $request->file('arquivo')->storeAs('public/compdecleis', $fileName);

        $compdecLei = new CompdecAnexo;

        $datetime_agora = Carbon::now();
        
        $compdecLei->arquivo = $fileName;
        $compdecLei->id_municipio = $request->id_municipio;
        $compdecLei->dt_anexo = $datetime_agora;
        $compdecLei->descricao = $request->descricao;
        $compdecLei->tipo = $request->tipo;
        $compdecLei->validade = $datetime_agora->addYear(1);
        $compdecLei->id_compdec = $request->id;
        $compdecLei->nome = $request->nome;

        if($compdecLei->save()){
            return back()
            ->with(['message' => 'Cadastro Realizado com Sucesso',
                    'active_tab' => '#-arquivo-tab']);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $compdecLeis = CompdecAnexo::find($id);

        $compdecLeis->delete();
        
        if(Storage::exists('public/compdecleis/'.$compdecLeis->arquivo)){
            Storage::delete('public/compdecleis/'.$compdecLeis->arquivo);
        }

        if($compdecLeis){
            return back()
                ->with([
                        'message' => 'Registro deletado com Sucesso !',
                        'active_tab' => '#-arquivo-tab',
                        ]);
        }
    }


    /**
     * visualizar Plano de contingencia.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function visualizar(Response $response, $arquivo)
    {
        return Storage::download('public/compdecleis/'.$arquivo, $arquivo);       
    }
}
