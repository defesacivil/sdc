<?php

namespace App\Http\Controllers;

use App\Models\Compdec\Interdicao;
use App\Models\Compdec\Vistoria;
use PDF;
use Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function PDFVistoria($id) {
        $data["email"] = "krystal.reichel13@ethereal.email";
        $data["title"] = "From SDC Laravel";
        $data["body"] = "This is Demo";

        $vistoria = Vistoria::find($id);
        
        $interdicao = Interdicao::where('ids_vistoria', $vistoria->id)->first();


        $img_el_estrs = [];

        $scan = Storage::allFiles('file_vistoria/' . $vistoria->id);
        foreach ($scan as $file) {
            if (substr(basename($file), 0, 8) == 'el_estr_') {
                $img_el_estrs[] = $file;
            }
        }

        //$imagens = Storage::allFiles(directory);      

        //dd($vistoria);

        $pdf = PDF::loadView('compdec/vistoria/show', [
                                                        'vistoria' => $vistoria,
                                                        'interdicao' => $interdicao,
                                                        'img_el_estrs' => $img_el_estrs,
                                                    ]);


  
        Mail::send('compdec/vistoria/show', [
            'vistoria' => $vistoria,
            'interdicao' => $interdicao,
            'img_el_estrs' => $img_el_estrs,
        ], function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "text.pdf");
        });
  
        dd('Mail sent successfully');
    }
}
