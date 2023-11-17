<?php

namespace App\Http\Controllers\Cedec;

use App\Http\Controllers\Controller;
use App\Models\Cedec\Cedec;
use Illuminate\Http\Request;

class CedecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cedec/index');
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
     * @param  \App\Models\Cedec\Cedec  $cedec
     * @return \Illuminate\Http\Response
     */
    public function show(Cedec $cedec)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cedec\Cedec  $cedec
     * @return \Illuminate\Http\Response
     */
    public function edit(Cedec $cedec)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cedec\Cedec  $cedec
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cedec $cedec)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cedec\Cedec  $cedec
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cedec $cedec)
    {
        //
    }


    /**
     * Undocumented function
     *
     * @param Cedec $cedec
     * @return void
     */
    public function help()
    {
        return view('cedec/help');
    }
}
