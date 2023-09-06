<?php

namespace App\Http\Controllers\Drrd;

use App\Models\Drrd\PaeAnalise;
use App\Models\Drrd\PaeNotificacao;
use Illuminate\Http\Request;

class PaeNotificacaoController extends \App\Http\Controllers\Controller
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
    public function create($analise_id)
    {
        $analise = PaeAnalise::with('protocolos',
                                    'protocolos.empreendimento',
                                    'protocolos.empreendimento.empreendedor')
                                    ->where('pae_analises.id', '=', $analise_id)
                                    ->get();
       
                                    //dd($analise[0]);
        return view('drrd/paebm/notificacao/create',
                    [
                        'analise' => $analise,
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
                'num_sei'           => "required|max:110",
                'user_id'           => "required|integer",
                'pae_analise_id'    => "required|integer",
                'dt_notificacao'    => "required|date",
                'prorrogacao'       => "required|max:1",
                'dt_devolutiva'      => "required|date",
                'obs'               => "required|max:255",
            ],
            [
                'num_sei.required' => 'O campo Número do Sei não está presente',
                'num_sei.max' => 'O campo Número do Sei suporta no máximo 110 caracteres',
                'user_id.required' => 'O campo Usuario é Obrigatório !',
                'user_id.integer' => 'O campo Usuario deve ser um número inteiro !',
                'pae_analise_id.required' => 'O campo Id da Análise é Obrigatório !',
                'pae_analise_id.integer' => 'O campo Id da Análise deve ser um número inteiro !',
                'dt_notificacao.required' => 'O campo Data da Notificação é Obrigatoria !',
                'dt_notificacao.date' => 'O campo Data da Notificação deve ser uma data válida !',
                'prorrogacao.required' => 'O campo Prorrogação deve ser escolhida',
                'prorrogacao.max' => 'O campo Prorrogação suporta no máximo 1 caracter',
                'dt_devolutiva.required' => 'O campo Data Evolutiva é Obrigatoria !',
                'dt_devolutiva.date' => 'O campo Data Evolutiva deve ser uma data válida !',
                'obs.required' => 'O campo Observação não está presente',
                'obs.max' => 'O campo Observação suporta no máximo 255 caracteres',
                
            ]
        );


        $notificacao = new PaeNotificacao;
        $notificacao->num_sei            = $request->num_sei;
        $notificacao->user_id            = $request->user_id;
        $notificacao->pae_analise_id     = $request->pae_analise_id;
        $notificacao->dt_notificacao     = $request->dt_notificacao;
        $notificacao->prorrogacao        = $request->prorrogacao;
        $notificacao->dt_devolutiva       = $request->dt_devolutiva;
        $notificacao->obs                = $request->obs;
        
        $notificacao->save();
    
        return redirect('pae/protocolo/show/'.$request->pae_protocolo_id)->with('message','Registro Gravado com Sucesso ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drrd\PaeNotificacao  $paeNotificacao
     * @return \Illuminate\Http\Response
     */
    public function show(PaeNotificacao $paeNotificacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drrd\PaeNotificacao  $paeNotificacao
     * @return \Illuminate\Http\Response
     */
    public function edit(PaeNotificacao $paeNotificacao)
    {
        $analise = PaeAnalise::with('protocolos',
                                    'protocolos.empreendimento',
                                    'protocolos.empreendimento.empreendedor')
                                    ->where('pae_analises.id', '=', $paeNotificacao->pae_analise_id)
                                    ->get();

        return view('drrd/paebm/notificacao/edit',
                        [
                            'notificacao' => $paeNotificacao,
                            'analise' => $analise,
                        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drrd\PaeNotificacao  $paeNotificacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaeNotificacao $paeNotificacao)
    {

        $request->validate(
            [
                'num_sei'           => "required|max:110",
                'user_id'           => "required|integer",
                'pae_analise_id'    => "required|integer",
                'dt_notificacao'    => "required|date",
                'prorrogacao'       => "required|max:1",
                'dt_devolutiva'      => "required|date",
                'obs'               => "required|max:255",
            ],
            [
                'num_sei.required' => 'O campo Número do Sei não está presente',
                'num_sei.max' => 'O campo Número do Sei suporta no máximo 110 caracteres',
                'user_id.required' => 'O campo Usuario é Obrigatório !',
                'user_id.integer' => 'O campo Usuario deve ser um número inteiro !',
                'pae_analise_id.required' => 'O campo Id da Análise é Obrigatório !',
                'pae_analise_id.integer' => 'O campo Id da Análise deve ser um número inteiro !',
                'dt_notificacao.required' => 'O campo Data da Notificação é Obrigatoria !',
                'dt_notificacao.date' => 'O campo Data da Notificação deve ser uma data válida !',
                'prorrogacao.required' => 'O campo Prorrogação deve ser escolhida',
                'prorrogacao.max' => 'O campo Prorrogação suporta no máximo 1 caracter',
                'dt_devolutiva.required' => 'O campo Data Evolutiva é Obrigatoria !',
                'dt_devolutiva.date' => 'O campo Data Evolutiva deve ser uma data válida !',
                'obs.required' => 'O campo Observação não está presente',
                'obs.max' => 'O campo Observação suporta no máximo 255 caracteres',
                
            ]
        );

        $paeNotificacao->num_sei          = $request->num_sei;
        $paeNotificacao->user_id          = $request->user_id;
        $paeNotificacao->pae_analise_id   = $request->pae_analise_id;
        $paeNotificacao->dt_notificacao   = $request->dt_notificacao;
        $paeNotificacao->prorrogacao      = $request->prorrogacao;
        $paeNotificacao->dt_devolutiva    = $request->dt_devolutiva;
        $paeNotificacao->obs              = $request->obs;

        $paeNotificacao->update();
    
        return redirect('pae/protocolo/show/'.$request->pae_protocolo_id)->with('message','Registro Atualizado com Sucesso ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drrd\PaeNotificacao  $paeNotificacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaeNotificacao $paeNotificacao)
    {
        //
    }
}
