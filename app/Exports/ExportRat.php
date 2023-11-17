<?php

namespace App\Exports;

use App\Models\Compdec\Rat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ExportRat implements FromCollection, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Rat::all();
    }

    public function headings(): array

    {
        return [
            'Código',
            'Número Ocorrência',
            'Data Ocorrência',
            'Município',
            'Operador',
            'Ocorrência',
            'Alvo',
            'Cobrade',
            'Descrição do Lugar',
            'Envolvidos',
            'Nome da Operação',
            'Endereco',
            'Número',
            'Bairro',
            'Estado',
            'Referência',
            'Cep',
            'Ações',
            'Data Atualização',
            'Data Criação'
        ];

    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Registros RAT';
    }
}
