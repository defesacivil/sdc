<?php

namespace App\Http\Controllers\Pmda;

use App\Http\Controllers\Controller;
use App\Models\Pmda\Pmda;
use App\Models\Pmda\PmdaPonto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PmdaPontoController extends Controller
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
                'nome' => 'required',
                'municipio_id' => 'required',
                'tipo' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'capacidade' => 'required',
            ],
            [
                'nome.required' => ' O campo :attribute é Obrigatório !',
                'municipio_id.required' => ' O campo :attribute é Obrigatório !',
                'tipo.required' => ' O campo :attribute é Obrigatório !',
                'latitude.required' => ' O campo :attribute é Obrigatório !',
                'longitude.required' => ' O campo :attribute é Obrigatório !',
                'capacidade.required' => ' O campo :attribute é Obrigatório !',
            ]
        );

        $ponto = new PmdaPonto;
        $pmda = Pmda::find($request->pmda_id);

        $ponto->nome         = $request->nome;
        $ponto->municipio_id = $request->municipio_id;
        $ponto->tipo         = $request->tipo;
        $ponto->latitude     = $request->latitude;
        $ponto->longitude    = $request->longitude;
        $ponto->capacidade   = $request->capacidade;

        if($ponto->save()){

            $pmda->pontos()->attach($ponto->id);

            Session::put('active-tab', '#-iss-tab');
            return response()->json(['message' =>'Registro Atualizado com Sucesso','active_tab' => '#-ponto-tab']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pmda\PmdaPonto  $pmdaPonto
     * @return \Illuminate\Http\Response
     */
    public function show(PmdaPonto $pmdaPonto)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        $result = PmdaPonto::where('nome', 'LIKE', '%' . $request->get('searchPonto') . '%')
        ->orWhere('tipo', 'LIKE', '%' . $request->get('searchPonto') . '%')
        ->orWhere('latitude', 'LIKE', '%' . $request->get('searchPonto') . '%')
        ->with('municipio')->get();
        /*->orWhere('latitude', 'LIKE', '%' . $request->get('searchPonto') . '%')
        ->orWhere('longitude', 'LIKE', '%' . $request->get('searchPonto') . '%');*/
        $dados = "";

       
        foreach ($result as $key => $value) {
            $dados .= "<tbody><tr>
                    <td>".$value['id']."</td>
                    <td>".$value['nome']."</td>
                    <td>".$value->municipio->nome."</td>
                    <td>".geraLinkMaps($value->latitude, $value->longitude, $value->latitude." ".$value->longitude)."</td>
                    <td><img name='btnAddPonto' data-id_ponto='".$value['id']."' src='".asset('imagem/icon/add.png')."' width='20px' title='Adicione O ponto de Captação nesse PMDA'></td>
                    </tr>
                    </tbody>";
        }
        return $dados;
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pmda\PmdaPonto  $pmdaPonto
     * @return \Illuminate\Http\Response
     */
    public function edit(PmdaPonto $pmdaPonto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pmda\PmdaPonto  $pmdaPonto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PmdaPonto $pmdaPonto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pmda\PmdaPonto  $pmdaPonto
     * @return \Illuminate\Http\Response
     */
    public function destroy(PmdaPonto $pmdaPonto)
    {
        //
    }
}
