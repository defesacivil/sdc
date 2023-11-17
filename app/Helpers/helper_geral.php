<?php

use Illuminate\Support\Str;

/**
 * Undocumented function
 *
 * @param [string] $lat - Latitude
 * @param [string] $long - Longitude
 * @param [string] $tit - Titulo
 * @return void
 */
function geraLinkMaps($lat, $long, $tit)
{

    return "<a title='Clique aqui para Visualizar o Mapa' href='http://maps.google.com/maps?q=" . $lat . "," . $long . "&t=k'>" . $tit . "</a>";
}


/**
 * Gerar sequencia de numeros
 * @param [int] $seq
 * @param [string] $digitos
 * @return void
 */
function geraNumSeq($seq, $digitos, $digito = 0)
{
    $seq = ($seq == 0) ? 1 : $seq;
    $num = "";

    for ($i = 0; $i < ($digitos - Str::length($seq)); $i++) {
        $num .= "0";
    }

    return $num . $seq;
};


$codAlvo = [
    "1" => "PESSOA",
    "2" => "INSTITUICAO FILANTROPICA1 ONO",
    "3" => "CONDOIMINIO",
    "4" => "COOPERATIVA",
    "5" => "DEPOSITO ",
    "6" => "EMBARCACAO AEREA / NAUTICA / TERRESTRE",
    "7" => "ESTABELECIMENTO COMERCIAL / SERVICOS",
    "8" => "ESTABELECIMENTO INDUSTRIAL / PRODUCAO / EXTRA",
    "9" => "LOCAL / ESTABELECIMENTO DE LAZER / CULTURA!",
    "10" => "RESIDENCIANOVEL RURAL",
    "11" => "INSTITUICAO DE ENSINO",
    "12" => "INSTITUICAO FINANCEIRA",
    "13" => "INSTITUICAO PUBLICA",
    "14" => "RESIDENCIA PLURIFAMLIAR / HOSPEDAGEM",
    "15" => "RESIDENCIA UNIFAMILIAR URBANA",
    "16" => "SERVICO DE SAUDE",
    "17" => "SINDICATO / ASSOCIACAO DE CLASSE",
    "18" => "AREA / EDIFICAÇÃO ESPECIAL",
    "19" => "UNIDADE DE CONSERVAÇÃO DA NATUREZA"
];
