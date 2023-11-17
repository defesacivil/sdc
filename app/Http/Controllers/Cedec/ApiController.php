<?php

namespace App\Http\Controllers\Cedec;

use App\Http\Controllers\Controller;
use App\Models\Cedec\Api;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ApiController extends Controller
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
     * @param  \App\Models\Cedec\Api  $api
     * @return \Illuminate\Http\Response
     */
    public function show(Api $api)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cedec\Api  $api
     * @return \Illuminate\Http\Response
     */
    public function edit(Api $api)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cedec\Api  $api
     * @return \Illuminate\Http\Response
     * 
     */
    public function update(User $user)
    {
        $token = $user->cpf . $user->email;

        //dd($user->cpf.$user->email, hash('sha256', $token));

        $user->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return ['token' => $token];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cedec\Api  $api
     * @return \Illuminate\Http\Response
     */
    public function autentica(Request $request)
    {

        $user = User::where('api_token', $request->token)->first();
        $url = $request->url;

        if (!is_null($user)) {

            Auth::loginUsingId($user->id);

            if (Auth::check()) {

                $this->update($user);

                return redirect('/dashboard');
            } else {
                return 'erro';
            }
        }else {
            return Redirect::to($url);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cedec\Api  $api
     * @return \Illuminate\Http\Response
     */
    public function destroy(Api $api)
    {
        //
    }
}
