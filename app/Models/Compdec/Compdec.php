<?php

namespace App\Models\Compdec;


use App\Models\Municipio\Municipio;
use App\Models\Compdec\CompdecUploadPlano;
use App\Models\Municipio\Regiao;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compdec extends Model
{
    protected $table = 'com_comdec';
    protected $primaryKey = 'id';

    protected $fillable =   [
        "fotoCompdec",
        "regiao_id",
        "associacao_id",
        "lei_num",
        "lei_data",
        "decreto_numero",
        "decreto_data",
        "port_numero",
        "port_data",
        "endereco",
        "fone_com1",
        "fone_com2",
        "fax",
        "efetivo",
        "qtd_efetivo",
        "email",
        "nupdec",
        "nupdec_qtd",
        "capacitacao_nupdec",
        "nupdec_org_rep",
        "territorio_id",
        "plano_cont",
        "cartao_pdc",
        "sede_propria",
        "viatura",
        "tem_simulado",
        "tem_mapeamento",
        "tem_computador",
        "curso_gestao",
        "dt_curso_gestao",
        "curso_sco",
        "dt_curso_sco",
        "exp_dc",
        "tp_ex_dc",
        "particip_workshop",
        "dt_partic_workshop",
        "possui_plano",
        "possui_cartao_def",
        "possui_capacitacao",
        "dt_capacitacao",
        "com_existente",
        "com_ativa",
        "tem_decreto",
        "tem_portaria",
        "tem_lei_criacao",
        "email2",
        "email3",
        "prefeito_nome",
        "prefeito_tel",
        "prefeito_cel",
        "prefeito_email",
        "municipio_nome",
        "inss_tem_cobranca",
        "inss_aliquota",
        "inss_lei_cobranca",
        "inss_resp_recolhe"

    ];

    use HasFactory;


    public function municipio()
    {
        return $this->hasOne(Municipio::class, 'id', 'id_municipio');
    }

    /**
     * Get the regiao associated with the Compdec
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function regiao()
    {
        return $this->hasOne(ComRegiao::class, 'id', 'regiao_id');
    }

    /**
     * Get the associacao associated with the Compdec
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function associacao()
    {
        return $this->hasOne(ComAssociacao::class, 'associacao_id', 'id');
    }

    /**
     * Get the territorio associated with the Compdec
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function territorio()
    {
        return $this->hasOne(ComTerritorio::class, 'terrotorio_id', 'id');
    }

    /**
     * Get all of the equipe Compdec for the CompdecController
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function equipes()
    {
        return $this->hasMany(CompdecEquipe::class, 'id_compdec', 'id');
    }

    /**
     * Get all of the anexo Arquivos for the CompdecController
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function arquivos()
    {
        return $this->hasMany(CompdecAnexo::class, 'compdec_id', 'id');
    }

    /**
     * Get all of the PLANO DE CONTINGENCIA for the CompdecController
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plano_contingencia()
    {
        return $this->hasMany(CompdecUploadPlano::class, 'compdec_id', 'id');
    }

    /**
     * Get the territorio associated with the Compdec
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function prefeitura()
    {
        return $this->hasOne(Prefeitura::class, 'id_municipio', 'id_municipio');
    }

}
