<?php

namespace App\Http\Controllers\Drrd;


use App\Models\Drrd\PaeAnalise;
use App\Models\Drrd\PaeProtocolo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaeAnaliseController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->method() == "GET") {

            $analises = PaeAnalise::paginate(7);

            return view(
                'drrd/paebm/analise/index',
                [
                    'analises' => $analises,
                ]
            );
        } elseif($request->method() == "POST") {

            $analises = PaeAnalise::where('pae_analises.nome', 'LIKE', '%' . $request->get('search') . '%')
                ->paginate();

                return view(
                    'drrd/paebm/analises/index',
                    [
                        'analises' => $analises,
                    ]
                );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $protocolo = PaeProtocolo::with('empreendimento',
                                        'empreendimento.empreendedor')
                                        ->where('pae_protocolos.id', '=', $request->id)->get();

        //dd($protocolo);

        return view('drrd/paebm/analise/create',
                    [
                        'protocolo' => $protocolo,
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
        $request->validate(
            [
                'parecer'=> "required|max:5000",
                'obs'    => "nullable|max:255",
                'tipo'   => "required|integer",
                'situacao' => 'required',
                'pae_protocolo_id'=> 'required',
                'anexo' => 'nullable|mimes:txt,doc,docx,pdf|max:2048',
            ],
            [
                'parecer.required' => 'O campo Parecer é Obrigatório !',
                'parecer.max' => 'O campo Parecer suporta no máximo 5000 caracteres !',
                'obs.max' => 'O campo Observação suporta no máximo 255 caracteres !',
                'tipo.required' => 'O campo Tipo é Obrigatório !',
                'tipo.max' => 'O campo Tipo suporta somente números !',
                'situacao.required' => "O campo Situação é Obrigatório!",    
                'pae_protocolo_id.required' => "O Campo Protocolo Id é obrigatorio !",
                'anexo.mimes' => "O campo Arquivo não tem um Anexo Permitido",
                'anexo.max' => "Tamanho maximo de arquivo permitido 2Mb !",
            ]
        );

        $analise = new PaeAnalise;
        
        $analise->parecer = $request->parecer;
        $analise->obs     = $request->obs;
        $analise->tipo    = $request->tipo;
        $analise->user_id    = $request->user_id;
        $analise->pae_protocolo_id    = $request->pae_protocolo_id;

        
        $analise->save();
        
        if(isset($request->anexo)){
            $fileName = $analise->id."-".time().'_'.$request->anexo->getClientOriginalName();
            $request->file('anexo')->storeAs('uploads', $fileName, 'public');
        }
  
        return redirect('pae/protocolo')->with('message','Registro Gravado com Sucesso ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drrd\PaeAnalise  $paeAnalise
     * @return \Illuminate\Http\Response
     */
    public function show(PaeAnalise $paeAnalise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drrd\PaeAnalise  $paeAnalise
     * @return \Illuminate\Http\Response
     */
    public function edit(PaeAnalise $paeAnalise)
    {
        $analise = PaeAnalise::with('protocolos',
                                    'protocolos.empreendimento',
                                    'protocolos.empreendimento.empreendedor')
                                ->where('pae_analises.id', '=', $paeAnalise->id)->get();

        //dd($analise[0]->protocolos);
        return view('drrd/paebm/analise/edit',
                    ['analise' => $analise]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drrd\PaeAnalise  $paeAnalise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaeAnalise $paeAnalise)
    {
        $request->validate(
            [
                'parecer'=> "required|max:5000",
                'obs'    => "nullable|max:255",
                'tipo'   => "required|integer",
                'situacao' => 'required',
                'pae_protocolo_id'=> 'required',
            ],
            [
                'parecer.required' => 'O campo Parecer é Obrigatório !',
                'parecer.max' => 'O campo Parecer suporta no máximo 5000 caracteres !',
                'obs.max' => 'O campo Observação suporta no máximo 255 caracteres !',
                'tipo.required' => 'O campo Tipo é Obrigatório !',
                'tipo.max' => 'O campo Tipo suporta somente números !',
                'situacao.required' => "O campo Situação é Obrigatório!",    
                'pae_protocolo_id.required' => "O Campo Protocolo Id é obrigatorio !",
            ]
        );

       
        $paeAnalise->parecer = $request->parecer;
        $paeAnalise->obs = $request->obs;
        $paeAnalise->tipo = $request->tipo;
        $paeAnalise->user_id = $request->user_id;
        $paeAnalise->pae_protocolo_id = $request->pae_protocolo_id;
        $paeAnalise->situacao = $request->situacao;
        

        $paeAnalise->update();
                
        return redirect('pae/protocolo/show/'.$request->pae_protocolo_id)->with('message','Registro Atualizado com Sucesso ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drrd\PaeAnalise  $paeAnalise
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaeAnalise $paeAnalise, $id)
    {
        $analise = $paeAnalise->find($id);

        $analise->delete();

        return redirect('pae/protocolo/show/'.$analise->pae_protocolo_id)->with('message','Registro Deletado com Sucesso ');
    }

    
    public function download($file) {
        return Storage::download('public/uploads/'.$file);

    }
}
