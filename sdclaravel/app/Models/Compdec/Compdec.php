<?php

namespace App\Models\Compdec;


use App\Models\Municipio\Municipio;
use App\Models\Compdec\CompdecUploadPlano;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compdec extends Model
{
    protected $table = 'com_comdec';
    protected $primaryKey = 'id';

    protected $fillable =   [
        "fotoCompdec",  "regiao_id",  "associacao_id",  "num_lei",  "dt_lei",  "num_decreto",  "dt_decreto",  "num_portaria",  "dt_portaria",
        "endereco",  "fone_com1",  "fone_com2",  "fax",  "efetivo",  "qtd_efetivo",  "email",  "nudec",  "qtd_nudec",  "capacitacao_nupdec",
        "org_rep",  "territorio_id",  "plano_cont",  "cartao_pdc",  "sede_propria",  "viatura",  "simulado",  "mapeamento",  "computador",
        "curso_gestao",  "dt_curso_gestao",  "curso_sco",  "dt_curso_sco",  "exp_dc",  "tp_ex_dc",  "particip_workshop",  "dt_partic_workshop",
        "possui_plano",  "possui_cartao_def",  "possui_capacitacao",  "dt_capacitacao",  "com_const",  "com_ativa",  "sem_decreto",
        "sem_portaria",  "sem_lei",  "email2",  "email3"
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
        return $this->hasOne(ComRegiao::class, 'regiao_id', 'id');
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
        return $this->hasMany(CompdecAnexo::class, 'id_compdec', 'id');
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
