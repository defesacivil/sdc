<?php

namespace App\Http\Controllers\Compdec;

use App\Http\Controllers\Controller;
use App\Models\Compdec\Interdicao;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class InterdicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interdicoes = Interdicao::paginate();

        return view(
            'compdec/interdicao/index',
            [
                'interdicoes' => $interdicoes,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compdec/interdicao/create');
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
     * @param  \App\Models\Compdec\Interdicao  $interdicao
     * @return \Illuminate\Http\Response
     */
    public function show($id_vistoria)
    {
        
        $interdicao = Interdicao::where('ids_vistoria', $id_vistoria)->firstOrFail();

        return view(
            'compdec/interdicao/show',
            [
                'interdicao' => $interdicao,
            ]
        );
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compdec\Interdicao  $interdicao
     * @return \Illuminate\Http\Response
     */
    public function edit(Interdicao $interdicao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compdec\Interdicao  $interdicao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interdicao $interdicao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compdec\Interdicao  $interdicao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interdicao $interdicao)
    {
        //
    }
}
