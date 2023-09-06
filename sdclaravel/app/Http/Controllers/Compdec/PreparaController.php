<?php

namespace App\Http\Controllers\Compdec;

use App\Http\Controllers\Controller;
use App\Models\Compdec\Prepara;
use Illuminate\Http\Request;

class PreparaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('compdec/prepara/index', [

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compdec/prepara/create', [
            
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compdec\Prepara  $prepara
     * @return \Illuminate\Http\Response
     */
    public function show(Prepara $prepara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compdec\Prepara  $prepara
     * @return \Illuminate\Http\Response
     */
    public function edit(Prepara $prepara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compdec\Prepara  $prepara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prepara $prepara)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compdec\Prepara  $prepara
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prepara $prepara)
    {
        //
    }
}
