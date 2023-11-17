<?php

namespace App\Exports;

use App\Models\Compdec\Vistoria;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ExportVistoria implements FromCollection, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Vistoria::all();
    }

    public function headings(): array

    {
        return [
            'Código',
            'Número',
            'Proprietário',
            'Data Registro',
            'Endereco',
            'Município',
            'Celular Contato',
            'Tipo Ocorrência',
            'Tipo Imóvel',
            'Trinca Pilar',
            'Trinca em Vigas',
            'Trinca em Lage',
            'Trinca em Parede',
            'Trinca em Piso',
            'Trinca em Muro',
            'Risco Colapso Elementos Estruturais',
            'Risco Colapso Elementos Construtivos',
            'Risco Colapso Externos',
            'Risco Colapso Vazamentos',
            'Agentes Externos Demormações no Muro',
            'Agentes Externos Ruptura Redes Hidráulicas',
            'Agentes Externos Deslizamentos Encosta Talude',
            'Agentes Externos Inundação',
            'Agentes Externos Outros',
            'Agentes Externos Outros Detalhe',
            'Nome do Municipio da Vistoria',
            'Caracterização Imóvel',
            'Parecer Conclusão',
            'Recomendações Providencias - Providências Imediatas',
            'Recomendações Providências - Medidas de Recuperção',
            'Considerações Finais',
            'Responsável Vistoriador',
            'Número de Moradores',
            'Tem idosos',
            'Tem Crianças',
            'Tem pessoas com dificuldade de locomoção',
            'Bairro',
            'Cep da Ocorrencia',
            'Latitude',
            'Longitude',
            'Tem Abastecimento de Água',
            'Possui sistema de Drenagem',
            'Número de Moradias',

           
        ];

    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Registros Vistorias';
    }
}
