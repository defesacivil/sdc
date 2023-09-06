<?php

namespace App\Http\Controllers\Ajuda;

use App\Models\Ajuda\Ajuda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AjudaController extends \App\Http\Controllers\Controller
{

    /**
     * Menu Ajuda humanitaria
     */
    public function menu(){
        Log::channel('usuario')->info('Acesso ao Menu Ajuda Humanitária', ['table' => 'users', 'id_usuario' => Auth::user()->id]);
        return view('ajuda/index');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function estoque()
    {
        Log::channel('usuario')->info('Acesso Módulo Controle de Estoque', ['table' => 'users', 'id_usuario' => Auth::user()->id]);
        return view('ajuda/estoque/index');
    }


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
     * @param  \App\Models\Ajuda\Ajuda  $ajuda
     * @return \Illuminate\Http\Response
     */
    public function show(Ajuda $ajuda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajuda\Ajuda  $ajuda
     * @return \Illuminate\Http\Response
     */
    public function edit(Ajuda $ajuda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajuda\Ajuda  $ajuda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ajuda $ajuda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajuda\Ajuda  $ajuda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ajuda $ajuda)
    {
        //
    }

    
}
