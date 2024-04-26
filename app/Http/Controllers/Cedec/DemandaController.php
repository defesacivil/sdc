<?php

namespace App\Http\Controllers\Cedec;

use App\Http\Controllers\Controller;
use App\Models\Cedec\Demanda;
use Illuminate\Http\Request;

class DemandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $catCollectcat = collect();

        $categorias = $catCollectcat->put('1', 'Cidade Administrativa');

        return view('cedec.demanda.index',
    [
            'categorias' => $categorias,
    ]);
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
     * @param  \App\Models\Cedec\Demanda  $demanda
     * @return \Illuminate\Http\Response
     */
    public function show(Demanda $demanda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cedec\Demanda  $demanda
     * @return \Illuminate\Http\Response
     */
    public function edit(Demanda $demanda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cedec\Demanda  $demanda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demanda $demanda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cedec\Demanda  $demanda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demanda $demanda)
    {
        //
    }
}
