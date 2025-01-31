<?php

namespace App\Http\Controllers\Cedec;

use App\Http\Controllers\Controller;
use App\Models\Cedec\Ajuda;
use Illuminate\Http\Request;

class AjudaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cedec.ajuda.index');
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
     * @param  \App\Models\Cedec\\Ajuda  $ajuda
     * @return \Illuminate\Http\Response
     */
    public function show(Ajuda $ajuda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cedec\\Ajuda  $ajuda
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
     * @param  \App\Models\Cedec\\Ajuda  $ajuda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ajuda $ajuda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cedec\\Ajuda  $ajuda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ajuda $ajuda)
    {
        //
    }
}
