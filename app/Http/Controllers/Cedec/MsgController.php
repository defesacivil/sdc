<?php

namespace App\Http\Controllers\Cedec;

use App\Http\Controllers\Controller;
use App\Models\Cedec\Msg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MsgController extends Controller
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

        $msg = new Msg();
        
        $msg->titulo = $request->titulo;
        $msg->mensagem = $request->mensagem;
        $msg->tipo = $request->tipo;
        $msg->status = 0;
        $msg->user_id = Auth::user()->id;
        $msg->grupo = $request->grupo;
        
        return $msg->save();


        //return redirect('boletim')->with('message','Registro Lançado com Sucesso ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cedec\Msg  $msg
     * @return \Illuminate\Http\Response
     */
    public function show(Msg $msg)
    {
        //
    }


    /**
     * Display the resource.
     *
     * @param  \App\Models\Cedec\Msg $msg
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function list(Msg $msg, Request $request)
    {
        view('cedec.msg.list');
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cedec\Msg  $msg
     * @return \Illuminate\Http\Response
     */
    public function edit(Msg $msg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cedec\Msg  $msg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Msg $msg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cedec\Msg  $msg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Msg $msg)
    {
        //
    }



    /**
     * despacho mensagens
     *
     * @param  \App\Models\Cedec\Msg  $msg
     * @return \Illuminate\Http\Response
     */
    public function despachos(Msg $msg, Request $request)
    {

                

        return $mensagens;
    }
}
