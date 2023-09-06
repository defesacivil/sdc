<?php

namespace App\Http\Controllers\Compdec;

use App\Models\Compdec\Prefeitura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrefeituraController extends \App\Http\Controllers\Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prefeitura  $prefeitura
     * @return \Illuminate\Http\Response
     */
    public function show(Prefeitura $prefeitura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prefeitura  $prefeitura
     * @return \Illuminate\Http\Response
     */
    public function edit(Prefeitura $prefeitura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prefeitura  $prefeitura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prefeitura $prefeitura)
    {
        //
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prefeitura  $prefeitura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prefeitura $prefeitura)
    {
        //
    }

    /**
     *  upload arquivo
     * 
     */
    public function upload(Request $request, $id){
       
        $request->validate([
            'fotoPref' => 'required|mimes:png,jpg,jpeg|max:300',
        ],
        [ 
            'required'  => 'Obrigatório anexar um arquivo !',
            'max'    => 'Arquivo muito grande, Tamanho Máximo permitido : 300kb',
            'mimes' => 'Tipo de Arquivos permitidos : png, jpg, jpeg',
        ]);

        $fileName = 'Prefeito-'.$id."-".time().'.'.$request->file('fotoPref')->extension();

        $request->file('fotoPref')->storeAs('prefeito', $fileName);
      
        $prefeitura = Prefeitura::where('id_municipio', $id)->firstOrFail();

        if(Storage::exists('prefeito/'.$prefeitura->fotoPref)){
            Storage::delete('prefeito/'.$prefeitura->fotoPref);
        }
        
        $prefeitura->fotoPref = $fileName;
        $prefeitura->save();

        return back()
            ->with('message','Upload realizado com Sucesso');

    }
}
