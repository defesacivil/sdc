<?php

namespace App\Http\Controllers\Compdec;

use App\Models\Compdec\CompdecUploadPlano;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class CompdecUploadPlanoController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // via relacionamento
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //via modal
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
        $request->validate([
            'file_plano' => 'required|mimes:pdf,doc,docx,odt|max:20000',
            'versao' => 'max:20',
            'obs' => 'max:200',
            'id_municipio' => 'required|integer',
        ],
        [ 
            'arquivo.required' => 'É obrigatório anexar um arquivo !',
            'versao.required'  => 'O tamanho máximo do Campo é de 20 Caracteres !',
            'obs.max'  => 'O tamanho máximo do Campo é de 200 Caracteres !',
            'mimes' => 'Tipo de Arquivos permitidos : PDF, DOC, DOCX, ODT',
            'id_municipio.required' => 'Aconteceu um erro interno !, Contate o Administrador',
        ]);

        $fileName = 'PLANO_DE_CONTIGENCIA_'.$request->id."-".time().'.'.$request->file('file_plano')->extension();
        $tamanho = $request->file('file_plano')->getSize();


        $request->file('file_plano')->storeAs('public/plano', $fileName);


        $plano = new CompdecUploadPlano;

        $datetime_agora = Carbon::now();
        
        $plano->file_plano = $fileName;
        $plano->versao = $request->versao;
        $plano->dt_upload = $datetime_agora;
        $plano->tamanho = $tamanho;
        $plano->obs = $request->obs;
        $plano->compdec_id = $request->id;

        if($plano->save()){
            return back()
            ->with(['message' => 'Upload Realizado com Sucesso',
                    'active_tab' => '#-plano-tab']);
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
        $compdecPlano = CompdecUploadPlano::find($id);

        $compdecPlano->delete();
        
        if(Storage::exists('public/plano/'.$compdecPlano->file_plano)){
            Storage::delete('public/plano/'.$compdecPlano->file_plano);
        }

        if($compdecPlano){
            return back()
                ->with([
                        'message' => 'Registro deletado com Sucesso !',
                        'active_tab' => '#-plano-tab',
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
        return Storage::download('public/plano/'.$arquivo, $arquivo);       
    }
    
}
