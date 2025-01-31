<?php

namespace App\Exports;

use App\Models\Ajuda\Cisterna;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportCisterna implements FromCollection, WithHeadings, WithTitle, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //return Cisterna::all();
        return Cisterna::with('getMunicipio')->get();
        //return Cisterna::find(1);
    }

    public function headings(): array

    {
        return [
            'id',
            'id_cad',
            'municipio',
            'comunidade',
            'nome',
            'endereco',
            'localização',
            'cpf',
            'dtNasc',
            'cadUnico',
            'qtdPessoa',
            'renda',
            'tipo_moradia',
            'outroMoradia',
            'compTelhado',
            'larguracompTelhado',
            'areaTotalTelhado',
            'compTestada',
            'numCaidaTelhado',
            'coberturaTelhado',
            'coberturaOutros',
            'existeFogaoLenha',
            'medidaTelhadoAreaFogao',
            'testadaDispParteFogao',
            'atendPipa',
            'respAtDefesaCivil',
            'respAtExercito',
            'respAtParticular',
            'respAtPrefeitura',
            'respAtOutros',
            'outroAtendPipa',
            'outrObs',
            'nomeAgente',
            'cpfAgente',
            'nomeEng',
            'creaEng',
            'obs',
            'tel',
            'created_at',


        ];
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Registros de Cadastro Projeto Convicênvia com a Seca';
    }

    /* mapeamento */
    public function map($cisterna): array
    {
        return [

            $cisterna->id,
            $cisterna->id_cad,
            $cisterna->getMunicipio->nome,
            $cisterna->comunidade,
            $cisterna->nome,
            $cisterna->endereco,
            $cisterna->localiza,
            $cisterna->cpf,
            $cisterna->dtNasc,
            $cisterna->cadUnico,
            $cisterna->qtdPessoa,
            $cisterna->renda,
            $cisterna->tipo_moradia,
            $cisterna->outroMoradia,
            $cisterna->compTelhado,
            $cisterna->larguracompTelhado,
            $cisterna->areaTotalTelhado,
            $cisterna->compTestada,
            $cisterna->numCaidaTelhado,
            $cisterna->coberturaTelhado,
            $cisterna->coberturaOutros,
            $cisterna->existeFogaoLenha ? 'Sim' : 'Não',
            $cisterna->medidaTelhadoAreaFogao,
            $cisterna->testadaDispParteFogao,
            $cisterna->atendPipa ? 'Sim' : 'Não',
            $cisterna->respAtDefesaCivil,
            $cisterna->respAtExercito,
            $cisterna->respAtParticular,
            $cisterna->respAtPrefeitura,
            $cisterna->respAtOutros,
            $cisterna->outroAtendPipa,
            $cisterna->outrObs,
            $cisterna->nomeAgente,
            $cisterna->cpfAgente,
            $cisterna->nomeEng,
            $cisterna->creaEng,
            $cisterna->obs,
            $cisterna->tel,
            $cisterna->created_at
        ];
    }
}
