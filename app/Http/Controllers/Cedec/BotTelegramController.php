<?php

namespace App\Http\Controllers\Cedec;

use App\Http\Controllers\Controller;
use App\Models\Cedec\BotTelegram;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class BotTelegramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $chats = Telegram::getUpdates();

        dd($chats);

        //print $chats[0];

        foreach($chats as $key=> $chat) {

            print json_decode($chat->update_id);
            //print json_decode($chat->message);
            //print $chat->message."<br>";
            //print $chat->chat."<br>";
        }
        //dd($response, "opa");



        // return view(
        //     'cedec/telegram/index',
        //     [
        //         'response' => $response,
        //     ]
        // );

        // return response()->json(
        //     [
        //         'rat' => $response,
        //     ],
        //     200,
        //     ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        //     JSON_UNESCAPED_UNICODE
        // );
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
     * @param  \App\Models\Cedec\\BotTelegram  $botTelegram
     * @return \Illuminate\Http\Response
     */
    public function show(BotTelegram $botTelegram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cedec\\BotTelegram  $botTelegram
     * @return \Illuminate\Http\Response
     */
    public function edit(BotTelegram $botTelegram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cedec\\BotTelegram  $botTelegram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BotTelegram $botTelegram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cedec\\BotTelegram  $botTelegram
     * @return \Illuminate\Http\Response
     */
    public function destroy(BotTelegram $botTelegram)
    {
        //
    }
}
