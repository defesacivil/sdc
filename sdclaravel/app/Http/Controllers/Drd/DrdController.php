<?php

namespace App\Http\Controllers\Drd;

use App\Models\Drd\Drd;
use Illuminate\Http\Request;

class DrdController extends \App\Http\Controllers\Controller
{
    
      
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('drd/index');
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
     * @param  \App\Models\Drd\Drd  $drd
     * @return \Illuminate\Http\Response
     */
    public function show(Drd $drd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drd\Drd  $drd
     * @return \Illuminate\Http\Response
     */
    public function edit(Drd $drd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drd\Drd  $drd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drd $drd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drd\Drd  $drd
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drd $drd)
    {
        //
    }
}
