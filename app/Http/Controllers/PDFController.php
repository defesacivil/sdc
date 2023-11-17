<?php

namespace App\Http\Controllers;

use App\Models\Compdec\Interdicao;
use App\Models\Compdec\Vistoria;
use PDF;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function PDFVistoria($id, $tp)
    {

        $data["email"] = "krystal.reichel13@ethereal.email";
        $data["title"] = "From SDC Laravel";
        $data["body"] = "This is Demo";

        $vistoria = Vistoria::find($id);

        $interdicao = Interdicao::where('ids_vistoria', $vistoria->id)->first();

        //dd(Storage::allFiles('file_vistoria/'));      

        $img_el_estrs = [];

        $scan = Storage::allFiles('file_vistoria/' . $vistoria->id);
        
        foreach ($scan as $file) {
            if (substr(basename($file), 0, 8) == 'el_estr_') {
                $img_el_estrs[] = $file;
            }
        }
        
        
        $pdf = PDF::loadView('compdec/vistoria/show', [
            'vistoria' => $vistoria,
            'interdicao' => $interdicao,
            'img_el_estrs' => $img_el_estrs,
            'pdf' => true,
        ]);
        
        $name_pdf = 'Relatorio_de_vistoria_'.Str::slug($vistoria->municipio['nome']).date('ymdHis').'.pdf';


        # envio email
        if ($tp == 'email') {

            Mail::send('compdec/vistoria/show', [
                'vistoria' => $vistoria,
                'interdicao' => $interdicao,
                'img_el_estrs' => $img_el_estrs,
                'pdf' => true,
            ], function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), 'Relatorio_de_vistoria_'.date('ymdHis').'.pdf');
            });

            return back()->with('message', 'Registro Atualizado com Sucesso !');

            #impressao PDF
        } elseif ($tp == 'pdf') {
            return $pdf->download($name_pdf);

        }
    }
}
