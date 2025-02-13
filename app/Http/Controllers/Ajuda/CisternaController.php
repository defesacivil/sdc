<?php

namespace App\Http\Controllers\Ajuda;

use App\Exports\ExportCisterna;
use App\Http\Controllers\Controller;
use App\Models\Ajuda\Cisterna;
use App\Models\Municipio\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CisternaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dados = Cisterna::with('getMunicipio')->get();

        $totalMunicipios = Cisterna::groupBy('municipio')->get();
        return view(
            'ajuda/cisterna/index',
            [
                'dados' => $dados,
                'totalMunicipios' => $totalMunicipios,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

$comunidades = '[
    {
        "municipio": "ALMENARA",
        "cod": "3101706",
        "comunidades": [
            {
                "id": "COMUNIDADE DA PRATINHA",
                "text": "COMUNIDADE DA PRATINHA"
            },
            {
                "id": "COMUNIDADE PRATA",
                "text": "COMUNIDADE PRATA"
            },
            {
                "id": "COMUNIDADE CRAQUIMOR",
                "text": "COMUNIDADE CRAQUIMOR"
            },
            {
                "id": "COMUNIDADE PALESTINA",
                "text": "COMUNIDADE PALESTINA"
            },
            {
                "id": "COMUNIDADE VILA RICA",
                "text": "COMUNIDADE VILA RICA"
            },
            {
                "id": "COMUNIDADE GENIPAPO",
                "text": "COMUNIDADE GENIPAPO"
            },
            {
                "id": "COMUNIDADE MACUCO",
                "text": "COMUNIDADE MACUCO"
            },
            {
                "id": "COMUNIDADE SANTA HELENA",
                "text": "COMUNIDADE SANTA HELENA"
            },
            {
                "id": "COMUNIDADE BARRAÇAO",
                "text": "COMUNIDADE BARRAÇAO"
            },
            {
                "id": "COMUNIDADE CALDEIROES",
                "text": "COMUNIDADE CALDEIROES"
            },
            {
                "id": "COMUNIDADE CORREGO DO LAJEDO",
                "text": "COMUNIDADE CORREGO DO LAJEDO"
            },
            {
                "id": "COMUNIDADE CORREGO DO VIGIA",
                "text": "COMUNIDADE CORREGO DO VIGIA"
            },
            {
                "id": "COMUNIDADE MUMBUCA",
                "text": "COMUNIDADE MUMBUCA"
            },
            {
                "id": "COMUNIDADE QUILOMBOLA MAROBA DOS TEIXEIRAS",
                "text": "COMUNIDADE QUILOMBOLA MAROBA DOS TEIXEIRAS"
            },
            {
                "id": "COMUNIDADE PADRE VALDIR",
                "text": "COMUNIDADE PADRE VALDIR"
            },
            {
                "id": "COMUNIDADE TURVO",
                "text": "COMUNIDADE TURVO"
            },
            {
                "id": "COMUNIDADE VITORIA DA AMARALINA",
                "text": "COMUNIDADE VITORIA DA AMARALINA"
            },
            {
                "id": "COMUNIDADE CAJUEIRO",
                "text": "COMUNIDADE CAJUEIRO"
            },
            {
                "id": "COMUNIDADE GRAVATA",
                "text": "COMUNIDADE GRAVATA"
            },
            {
                "id": "COMUNIDADE PRINCESINHA DO VALE",
                "text": "COMUNIDADE PRINCESINHA DO VALE"
            },
            {
                "id": "COMUNIDADE CORREGO DE AREIA",
                "text": "COMUNIDADE CORREGO DE AREIA"
            }
        ]
    },
    {
        "municipio": "ARICANDUVA",
        "cod": "3104452",
        "comunidades": [
            {
                "id": "SAPUCAIA",
                "text": "SAPUCAIA"
            },
            {
                "id": "MUTAMBA",
                "text": "MUTAMBA"
            },
            {
                "id": "BARRA DO CAPUCHO",
                "text": "BARRA DO CAPUCHO"
            },
            {
                "id": "OURO FINO II",
                "text": "OURO FINO II"
            },
            {
                "id": "PACA",
                "text": "PACA"
            },
            {
                "id": "SANTO ANTONIO DE ARICANDUVA",
                "text": "SANTO ANTONIO DE ARICANDUVA"
            },
            {
                "id": "SAO LOURENCO",
                "text": "SAO LOURENCO"
            },
            {
                "id": "BELA VISTA",
                "text": "BELA VISTA"
            },
            {
                "id": "BOM JESUS",
                "text": "BOM JESUS"
            },
            {
                "id": "JUAZEIRO",
                "text": "JUAZEIRO"
            },
            {
                "id": "QUEBRABO",
                "text": "QUEBRABO"
            },
            {
                "id": "SERRA DA NORUEGA",
                "text": "SERRA DA NORUEGA"
            },
            {
                "id": "CAPUCHO",
                "text": "CAPUCHO"
            },
            {
                "id": "COMUNIDADE BEM VIVER",
                "text": "COMUNIDADE BEM VIVER"
            },
            {
                "id": "OURO FINO I",
                "text": "OURO FINO I"
            },
            {
                "id": "SANTO ANTONIO DOS MONTEIROS",
                "text": "SANTO ANTONIO DOS MONTEIROS"
            },
            {
                "id": "SAO PEDRO",
                "text": "SAO PEDRO"
            },
            {
                "id": "SAO JOSE",
                "text": "SAO JOSE"
            }
        ]
    },
    {
        "municipio": "ARINOS",
        "cod": "3104502",
        "comunidades": [
            {
                "id": "PA SANTO ANTONIO DO GERAIS",
                "text": "PA SANTO ANTONIO DO GERAIS"
            },
            {
                "id": "IPUEIRA",
                "text": "IPUEIRA"
            },
            {
                "id": "PA CAI SARA",
                "text": "PA CAI SARA"
            },
            {
                "id": "PA RIACHO CLARO",
                "text": "PA RIACHO CLARO"
            },
            {
                "id": "PA ROÇA",
                "text": "PA ROÇA"
            },
            {
                "id": "PA SANTA TEREZINHA",
                "text": "PA SANTA TEREZINHA"
            },
            {
                "id": "PA CARLOS LAMARCA",
                "text": "PA CARLOS LAMARCA"
            },
            {
                "id": "PA CARRO QUEBRADO",
                "text": "PA CARRO QUEBRADO"
            },
            {
                "id": "PA ELOIS FERREIRA",
                "text": "PA ELOIS FERREIRA"
            },
            {
                "id": "PA MIMOSO",
                "text": "PA MIMOSO"
            },
            {
                "id": "PA PAULO FREIRE",
                "text": "PA PAULO FREIRE"
            },
            {
                "id": "APROCONVE-BREJO",
                "text": "APROCONVE-BREJO"
            },
            {
                "id": "ASSOCIAÇAO SANTA MARIA 2",
                "text": "ASSOCIAÇAO SANTA MARIA 2"
            },
            {
                "id": "FAZENDA MENINO",
                "text": "FAZENDA MENINO"
            },
            {
                "id": "VALE DO SANTA MARIA",
                "text": "VALE DO SANTA MARIA"
            }
        ]
    },
    {
        "municipio": "BERILO",
        "cod": "3106507",
        "comunidades": [
            {
                "id": "VEREDAS",
                "text": "VEREDAS"
            },
            {
                "id": "ABREU",
                "text": "ABREU"
            },
            {
                "id": "ITACAMBIRA",
                "text": "ITACAMBIRA"
            },
            {
                "id": "CAETETU DO MEIO",
                "text": "CAETETU DO MEIO"
            },
            {
                "id": "DATAS",
                "text": "DATAS"
            },
            {
                "id": "VAI LAVANDO",
                "text": "VAI LAVANDO"
            }
        ]
    },
    {
        "municipio": "BERIZAL",
        "cod": "3106655",
        "comunidades": [
            {
                "id": "PE DO MORRO",
                "text": "PE DO MORRO"
            },
            {
                "id": "TABATINGA",
                "text": "TABATINGA"
            },
            {
                "id": "AGUA BRANCA",
                "text": "AGUA BRANCA"
            },
            {
                "id": "CAPIM DE CHEIRO",
                "text": "CAPIM DE CHEIRO"
            },
            {
                "id": "MORRO AGUDO",
                "text": "MORRO AGUDO"
            },
            {
                "id": "CALDEIRAO",
                "text": "CALDEIRAO"
            },
            {
                "id": "ITABERABA",
                "text": "ITABERABA"
            },
            {
                "id": "TAPERINHA",
                "text": "TAPERINHA"
            },
            {
                "id": "ILHA",
                "text": "ILHA"
            }
        ]
    },
    {
        "municipio": "BOCAIUVA",
        "cod": "3107307",
        "comunidades": [
            {
                "id": "CURRAL DE VARAS (FAZ ONÇA)",
                "text": "CURRAL DE VARAS (FAZ ONÇA)"
            },
            {
                "id": "FORQUILHA",
                "text": "FORQUILHA"
            },
            {
                "id": "OLHO DAGUA SIMAO",
                "text": "OLHO DAGUA SIMAO"
            },
            {
                "id": "POCOES",
                "text": "POCOES"
            },
            {
                "id": "CABECEIRA FAZENDA ONÇA",
                "text": "CABECEIRA FAZENDA ONÇA"
            },
            {
                "id": "MORRINHOS I",
                "text": "MORRINHOS I"
            },
            {
                "id": "RETA GRANDE I",
                "text": "RETA GRANDE I"
            },
            {
                "id": "RETA GRANDE II",
                "text": "RETA GRANDE II"
            },
            {
                "id": "TRACADAL",
                "text": "TRACADAL"
            },
            {
                "id": "ASS, BARRAGEM CAATINGA",
                "text": "ASS, BARRAGEM CAATINGA"
            },
            {
                "id": "CABECEIRA CURRAL DE VARAS",
                "text": "CABECEIRA CURRAL DE VARAS"
            },
            {
                "id": "RETA GRANDE III",
                "text": "RETA GRANDE III"
            },
            {
                "id": "LAGOA GRANDE",
                "text": "LAGOA GRANDE"
            },
            {
                "id": "ANGICO",
                "text": "ANGICO"
            },
            {
                "id": "BARRAGEM DO BAMBU",
                "text": "BARRAGEM DO BAMBU"
            },
            {
                "id": "FAZ, JACARE - ASSENT, PROFESSOR MAZAN",
                "text": "FAZ, JACARE - ASSENT, PROFESSOR MAZAN"
            },
            {
                "id": "GARROTE I & ASSENT,GARROTE",
                "text": "GARROTE I & ASSENT,GARROTE"
            },
            {
                "id": "POCO BENTO",
                "text": "POCO BENTO"
            },
            {
                "id": "TABOQUINHA",
                "text": "TABOQUINHA"
            },
            {
                "id": "TRIUNFO",
                "text": "TRIUNFO"
            }
        ]
        
    },
    {
        "municipio": "BOTUMIRIM",
        "cod": "3108503",
        "comunidades": [
            {
                "id": "ATALHO",
                "text": "ATALHO"
            },
            {
                "id": "COMUNIDADE BONITO",
                "text": "COMUNIDADE BONITO"
            },
            {
                "id": "ROCINHA",
                "text": "ROCINHA"
            },
            {
                "id": "PARA TERRA MARAVILHA",
                "text": "PARA TERRA MARAVILHA"
            },
            {
                "id": "TRAÇADAL",
                "text": "TRAÇADAL"
            }
        ]
    },
    {
        "municipio": "BURITIZEIRO",
        "cod": "3109402",
        "comunidades": [
            {
                "id": "COMUNIDADE LAGES",
                "text": "COMUNIDADE LAGES"
            },
            {
                "id": "COMUNIDADE TRIANGULO FORMOSO",
                "text": "COMUNIDADE TRIANGULO FORMOSO"
            },
            {
                "id": "COMUNIDADE RIBEIRAO",
                "text": "COMUNIDADE RIBEIRAO"
            },
            {
                "id": "COMUNIDADE TATAIRA",
                "text": "COMUNIDADE TATAIRA"
            },
            {
                "id": "SANTA HELENA",
                "text": "SANTA HELENA"
            },
            {
                "id": "ASSENTAMENTO 1 DE MAIO",
                "text": "ASSENTAMENTO 1 DE MAIO"
            },
            {
                "id": "QUATIS",
                "text": "QUATIS"
            },
            {
                "id": "VARGINHA",
                "text": "VARGINHA"
            }
        ]
    },
    {
        "municipio": "CAPITÃO ENÉAS",
        "cod": "3112703",
        "comunidades": [
            {
                "id": "CACAREMA",
                "text": "CACAREMA"
            },
            {
                "id": "VIRGILANDIA",
                "text": "VIRGILANDIA"
            },
            {
                "id": "SERROTE",
                "text": "SERROTE"
            },
            {
                "id": "POCO DOCE",
                "text": "POCO DOCE"
            },
            {
                "id": "MALHADA REAL",
                "text": "MALHADA REAL"
            },
            {
                "id": "ORION",
                "text": "ORION"
            }
        ]
    },
    {
        "municipio": "CARBONITA",
        "cod": "3113503",
        "comunidades": [
            {
                "id": "MERCADINHO",
                "text": "MERCADINHO"
            },
            {
                "id": "BERNARDOS",
                "text": "BERNARDOS"
            },
            {
                "id": "CAPIM PUBO",
                "text": "CAPIM PUBO"
            },
            {
                "id": "CAPOEIRAO",
                "text": "CAPOEIRAO"
            },
            {
                "id": "LAJES",
                "text": "LAJES"
            },
            {
                "id": "MONTE BELO",
                "text": "MONTE BELO"
            },
            {
                "id": "SANTANA",
                "text": "SANTANA"
            }
        ]
    },
    {
        "municipio": "CATUTI",
        "cod": "3115474",
        "comunidades": [
            {
                "id": "TABULEIRO",
                "text": "TABULEIRO"
            },
            {
                "id": "POÇOES",
                "text": "POÇOES"
            },
            {
                "id": "VILA SANTOS REIS",
                "text": "VILA SANTOS REIS"
            },
            {
                "id": "SAMBAIBA",
                "text": "SAMBAIBA"
            },
            {
                "id": "SANTA RITA",
                "text": "SANTA RITA"
            },
            {
                "id": "FERRAZ",
                "text": "FERRAZ"
            },
            {
                "id": "MALHADA GRANDE",
                "text": "MALHADA GRANDE"
            },
            {
                "id": "PAU A PIQUE I",
                "text": "PAU A PIQUE I"
            },
            {
                "id": "TAMANDUA",
                "text": "TAMANDUA"
            },
            {
                "id": "BARREIRO BRANCO",
                "text": "BARREIRO BRANCO"
            },
            {
                "id": "LINGUA DAGUA",
                "text": "LINGUA DAGUA"
            },
            {
                "id": "MALHADINHA",
                "text": "MALHADINHA"
            },
            {
                "id": "PAU A PIQUE II",
                "text": "PAU A PIQUE II"
            },
            {
                "id": "SALININHAS",
                "text": "SALININHAS"
            },
            {
                "id": "ILHA GRANDE I",
                "text": "ILHA GRANDE I"
            },
            {
                "id": "ILHA GRANDE II",
                "text": "ILHA GRANDE II"
            }
        ]
    },
    {
        "municipio": "CHAPADA DO NORTE",
        "cod": "3116100",
        "comunidades": [
            {
                "id": "CORREGO DAS ALMAS",
                "text": "CORREGO DAS ALMAS"
            },
            {
                "id": "CORREGO DO ROCHA",
                "text": "CORREGO DO ROCHA"
            },
            {
                "id": "AGUA SUJA",
                "text": "AGUA SUJA"
            },
            {
                "id": "TOLDA",
                "text": "TOLDA"
            },
            {
                "id": "FERREIRAS",
                "text": "FERREIRAS"
            }
        ]
    },
    {
        "municipio": "CÔNEGO MARINHO",
        "cod": "3117836",
        "comunidades": [
            {
                "id": "BARREIRO DO BORRACHUDO",
                "text": "BARREIRO DO BORRACHUDO"
            },
            {
                "id": "CRUZ ARAUJO",
                "text": "CRUZ ARAUJO"
            },
            {
                "id": "CURRAL VELHO",
                "text": "CURRAL VELHO"
            },
            {
                "id": "FORQUILHA MARINHO",
                "text": "FORQUILHA MARINHO"
            },
            {
                "id": "LAPINHA",
                "text": "LAPINHA"
            },
            {
                "id": "CORREDOR",
                "text": "CORREDOR"
            },
            {
                "id": "QUEIMADA GRANDE",
                "text": "QUEIMADA GRANDE"
            },
            {
                "id": "BEIRA DA CRUZ",
                "text": "BEIRA DA CRUZ"
            },
            {
                "id": "CABECEIRA DO POÇAO",
                "text": "CABECEIRA DO POÇAO"
            },
            {
                "id": "CANDEAL BANDEIRAS",
                "text": "CANDEAL BANDEIRAS"
            },
            {
                "id": "CANDEAL OLARIA CUPIM",
                "text": "CANDEAL OLARIA CUPIM"
            },
            {
                "id": "COMUNIDADE DE SAPE",
                "text": "COMUNIDADE DE SAPE"
            }
        ]
    },
    {
        "municipio": "CORONEL MURTA",
        "cod": "3119500",
        "comunidades": [
            {
                "id": "MUTUCA",
                "text": "MUTUCA"
            },
            {
                "id": "VEREDA",
                "text": "VEREDA"
            },
            {
                "id": "OLHO DAGUA DE CIMA",
                "text": "OLHO DAGUA DE CIMA"
            },
            {
                "id": "TERRA VERMELHA",
                "text": "TERRA VERMELHA"
            },
            {
                "id": "ALTO MORRO REDONDO",
                "text": "ALTO MORRO REDONDO"
            },
            {
                "id": "BELA VISTA",
                "text": "BELA VISTA"
            },
            {
                "id": "JACÚ",
                "text": "JACÚ"
            },
            {
                "id": "ÁGUA BRANCA",
                "text": "ÁGUA BRANCA"
            },
            {
                "id": "BAIXÃO",
                "text": "BAIXÃO"
            },
            {
                "id": "CAPOEIRINHA",
                "text": "CAPOEIRINHA"
            },
            {
                "id": "LAGINHA",
                "text": "LAGINHA"
            },
            {
                "id": "OLHO DAGUA DE BAIXO",
                "text": "OLHO DAGUA DE BAIXO"
            },
            {
                "id": "PACHECO",
                "text": "PACHECO"
            },
            {
                "id": "ITACAMBIRA",
                "text": "ITACAMBIRA"
            },
            {
                "id": "LAGE",
                "text": "LAGE"
            },
            {
                "id": "MORRO REDONDO",
                "text": "MORRO REDONDO"
            },
            {
                "id": "PALMEIRAS",
                "text": "PALMEIRAS"
            },
            {
                "id": "JATOBÁ",
                "text": "JATOBÁ"
            },
            {
                "id": "SÃO JOSÉ",
                "text": "SÃO JOSÉ"
            }
        ]
    },
    {
        "municipio": "CRISTÁLIA",
        "cod": "3120300",
        "comunidades": [
            {
                "id": "MADALENA",
                "text": "MADALENA"
            },
            {
                "id": "SAO JOAO",
                "text": "SAO JOAO"
            },
            {
                "id": "SANTA ROSA",
                "text": "SANTA ROSA"
            },
            {
                "id": "BARREIRO DA CRUZ TABOA",
                "text": "BARREIRO DA CRUZ TABOA"
            },
            {
                "id": "BURITI",
                "text": "BURITI"
            },
            {
                "id": "CLAUDIO",
                "text": "CLAUDIO"
            },
            {
                "id": "PIABANHA",
                "text": "PIABANHA"
            },
            {
                "id": "AROEIRA",
                "text": "AROEIRA"
            },
            {
                "id": "CAMARGO",
                "text": "CAMARGO"
            },
            {
                "id": "TAMBURIL",
                "text": "TAMBURIL"
            },
            {
                "id": "BATEEIRO",
                "text": "BATEEIRO"
            },
            {
                "id": "BOA VISTA DO BANANAL",
                "text": "BOA VISTA DO BANANAL"
            },
            {
                "id": "CORREGO DANTAS",
                "text": "CORREGO DANTAS"
            },
            {
                "id": "PAIOL",
                "text": "PAIOL"
            },
            {
                "id": "PIEDADE",
                "text": "PIEDADE"
            },
            {
                "id": "SANTA CRUZ",
                "text": "SANTA CRUZ"
            },
            {
                "id": "SAO MIGUEL",
                "text": "SAO MIGUEL"
            }
        ]
    },
    {
        "municipio": "CURRAL DE DENTRO",
        "cod": "3120870",
        "comunidades": [
            {
                "id": "LARANJAO",
                "text": "LARANJAO"
            },
            {
                "id": "ILHA GRANDE",
                "text": "ILHA GRANDE"
            },
            {
                "id": "BOA SORTE",
                "text": "BOA SORTE"
            },
            {
                "id": "LAGOA DE JABOTICABA",
                "text": "LAGOA DE JABOTICABA"
            },
            {
                "id": "GAMELEIRA",
                "text": "GAMELEIRA"
            },
            {
                "id": "GENTIL",
                "text": "GENTIL"
            },
            {
                "id": "MACUCO",
                "text": "MACUCO"
            },
            {
                "id": "ITABERABA",
                "text": "ITABERABA"
            }
        ]
    },
    {
        "municipio": "FELISBURGO",
        "cod": "3125606",
        "comunidades": [
            {
                "id": "ASSENTAMENTO TERRA PROMETIDA",
                "text": "ASSENTAMENTO TERRA PROMETIDA"
            },
            {
                "id": "PRATES",
                "text": "PRATES"
            },
            {
                "id": "TANQUE III",
                "text": "TANQUE III"
            },
            {
                "id": "VENTANIA",
                "text": "VENTANIA"
            },
            {
                "id": "CORREGO AZUL",
                "text": "CORREGO AZUL"
            }
        ]
    },
    {
        "municipio": "FRANCISCO DUMONT",
        "cod": "3126604",
        "comunidades": [
            {
                "id": "COVANCAS",
                "text": "COVANCAS"
            },
            {
                "id": "VILA UNIDA",
                "text": "VILA UNIDA"
            },
            {
                "id": "CIPO",
                "text": "CIPO"
            },
            {
                "id": "AGUA BRANCA",
                "text": "AGUA BRANCA"
            }
        ]
    },
    {
        "municipio": "GAMELEIRAS",
        "cod": "3127339",
        "comunidades": [
            {
                "id": "ASSENTAMENTO AGRONORTE",
                "text": "ASSENTAMENTO AGRONORTE"
            },
            {
                "id": "RAPOSA",
                "text": "RAPOSA"
            },
            {
                "id": "GORUTUBA (REGIAO)",
                "text": "GORUTUBA (REGIAO)"
            },
            {
                "id": "VEREDA DE GAMELEIRA",
                "text": "VEREDA DE GAMELEIRA"
            },
            {
                "id": "VILA DO JACU",
                "text": "VILA DO JACU"
            },
            {
                "id": "VEREDA DO BREJO",
                "text": "VEREDA DO BREJO"
            },
            {
                "id": "BREJO DOS MARTIRES",
                "text": "BREJO DOS MARTIRES"
            }
        ]
    },
    {
        "municipio": "GRÃO MOGOL",
        "cod": "3127800",
        "comunidades": [
            {
                "id": "CAMPO ALTO",
                "text": "CAMPO ALTO"
            },
            {
                "id": "PEDRINHA",
                "text": "PEDRINHA"
            },
            {
                "id": "BONITO CANCELA",
                "text": "BONITO CANCELA"
            },
            {
                "id": "CORREGO DO MATO",
                "text": "CORREGO DO MATO"
            },
            {
                "id": "SAO JOSE",
                "text": "SAO JOSE"
            },
            {
                "id": "ACAMPAMENTO AVILMAR",
                "text": "ACAMPAMENTO AVILMAR"
            },
            {
                "id": "ANGICO GANGORRA",
                "text": "ANGICO GANGORRA"
            },
            {
                "id": "VENTANIA",
                "text": "VENTANIA"
            },
            {
                "id": "CAPIVARA",
                "text": "CAPIVARA"
            },
            {
                "id": "LAGES PONTE ALTA",
                "text": "LAGES PONTE ALTA"
            },
            {
                "id": "PORTEIRAS",
                "text": "PORTEIRAS"
            },
            {
                "id": "CABEÇADA",
                "text": "CABEÇADA"
            },
            {
                "id": "TINGUI",
                "text": "TINGUI"
            },
            {
                "id": "VARZEA DA CANA",
                "text": "VARZEA DA CANA"
            }
        ]
    },
    {
        "municipio": "GUARACIAMA",
        "cod": "3128253",
        "comunidades": [
            {
                "id": "BURITIZAL",
                "text": "BURITIZAL"
            },
            {
                "id": "MAE DOMINGA",
                "text": "MAE DOMINGA"
            },
            {
                "id": "CABECEIRA DO RIO DAS PEDRAS",
                "text": "CABECEIRA DO RIO DAS PEDRAS"
            },
            {
                "id": "CABECEIRA DO RIO DO FELIX",
                "text": "CABECEIRA DO RIO DO FELIX"
            },
            {
                "id": "CANA BRAVA",
                "text": "CANA BRAVA"
            },
            {
                "id": "COMUNIDADE DE VARGEM MIMOSA",
                "text": "COMUNIDADE DE VARGEM MIMOSA"
            },
            {
                "id": "COMUNIDADE DE RIO DAS PEDRAS II",
                "text": "COMUNIDADE DE RIO DAS PEDRAS II"
            },
            {
                "id": "BARREIRO DO CAMPO",
                "text": "BARREIRO DO CAMPO"
            },
            {
                "id": "COMUNIDADE DE SOBRAINHO",
                "text": "COMUNIDADE DE SOBRAINHO"
            },
            {
                "id": "ESTIVA",
                "text": "ESTIVA"
            },
            {
                "id": "BREJINHO",
                "text": "BREJINHO"
            }
        ]
    },
    {
        "municipio": "IBIAÍ",
        "cod": "3129608",
        "comunidades": [
            {
                "id": "CAPIM BRANCO",
                "text": "CAPIM BRANCO"
            },
            {
                "id": "SABOES - BREJINHO",
                "text": "SABOES - BREJINHO"
            },
            {
                "id": "PONTE",
                "text": "PONTE"
            },
            {
                "id": "RETIRO",
                "text": "RETIRO"
            },
            {
                "id": "SANTA CRUZ - TOCANTINS",
                "text": "SANTA CRUZ - TOCANTINS"
            },
            {
                "id": "BURITIZINHO",
                "text": "BURITIZINHO"
            },
            {
                "id": "MORRO DOS PORCOS",
                "text": "MORRO DOS PORCOS"
            },
            {
                "id": "BARREIRO DO CAMPO",
                "text": "BARREIRO DO CAMPO"
            },
            {
                "id": "CAATINGA",
                "text": "CAATINGA"
            }
        ]
    },
    {
        "municipio": "IBIRACATU",
        "cod": "3129657",
        "comunidades": [
            {
                "id": "SAO FELIPE",
                "text": "SAO FELIPE"
            },
            {
                "id": "BURITI",
                "text": "BURITI"
            },
            {
                "id": "JATOBA",
                "text": "JATOBA"
            },
            {
                "id": "SAO JOAO",
                "text": "SAO JOAO"
            },
            {
                "id": "CAPEBA",
                "text": "CAPEBA"
            },
            {
                "id": "BURITI II",
                "text": "BURITI II"
            },
            {
                "id": "TABOQUINHAS",
                "text": "TABOQUINHAS"
            }
        ]
    },
    {
        "municipio": "INDAIABIRA",
        "cod": "3130655",
        "comunidades": [
            {
                "id": "CURRAL NOVO",
                "text": "CURRAL NOVO"
            },
            {
                "id": "FAZENDA CAVADA",
                "text": "FAZENDA CAVADA"
            },
            {
                "id": "GAMELEIRA",
                "text": "GAMELEIRA"
            },
            {
                "id": "MUZELO",
                "text": "MUZELO"
            },
            {
                "id": "TAQUARIL",
                "text": "TAQUARIL"
            },
            {
                "id": "CANABRAVA I",
                "text": "CANABRAVA I"
            },
            {
                "id": "FAZENDA GRANDE",
                "text": "FAZENDA GRANDE"
            },
            {
                "id": "VEREDA DO ATOLEIRO",
                "text": "VEREDA DO ATOLEIRO"
            },
            {
                "id": "BARRA DE AREIA",
                "text": "BARRA DE AREIA"
            },
            {
                "id": "CAICARA",
                "text": "CAICARA"
            },
            {
                "id": "CANABRAVA",
                "text": "CANABRAVA"
            },
            {
                "id": "CATULE",
                "text": "CATULE"
            },
            {
                "id": "FAZENDA AREIA",
                "text": "FAZENDA AREIA"
            },
            {
                "id": "FAZENDA GADO BRAVO E LOBEIRO",
                "text": "FAZENDA GADO BRAVO E LOBEIRO"
            },
            {
                "id": "FAZENDA TOMBADOR",
                "text": "FAZENDA TOMBADOR"
            },
            {
                "id": "GAMELAS",
                "text": "GAMELAS"
            },
            {
                "id": "LAGOA DA PEDRA",
                "text": "LAGOA DA PEDRA"
            },
            {
                "id": "MARAVILHA",
                "text": "MARAVILHA"
            },
            {
                "id": "MOCAMBO",
                "text": "MOCAMBO"
            }
        ]
    },
    {
        "municipio": "ITACAMBIRA",
        "cod": "3132008",
        "comunidades": [
            {
                "id": "AREAO",
                "text": "AREAO"
            },
            {
                "id": "BOA SORTE",
                "text": "BOA SORTE"
            },
            {
                "id": "BARRA DO RIO PRETO",
                "text": "BARRA DO RIO PRETO"
            },
            {
                "id": "CRISPIM",
                "text": "CRISPIM"
            },
            {
                "id": "NOVA ESPERANCA",
                "text": "NOVA ESPERANCA"
            },
            {
                "id": "BOA VISTA",
                "text": "BOA VISTA"
            },
            {
                "id": "CORREGO DA ONCA",
                "text": "CORREGO DA ONCA"
            },
            {
                "id": "TOCOIOS",
                "text": "TOCOIOS"
            }
        ]
    },
    {
        "municipio": "ITACARAMBI",
        "cod": "3132107",
        "comunidades": [
            {
                "id": "ACAMPAMENTO SAO FRANCISCO",
                "text": "ACAMPAMENTO SAO FRANCISCO"
            },
            {
                "id": "SERRARIA",
                "text": "SERRARIA"
            },
            {
                "id": "VARZEA GRANDE",
                "text": "VARZEA GRANDE"
            },
            {
                "id": "RIACHO PAJEU - LOCALIDADE POÇO VERDE",
                "text": "RIACHO PAJEU - LOCALIDADE POÇO VERDE"
            },
            {
                "id": "SERIEMA",
                "text": "SERIEMA"
            },
            {
                "id": "ACAMPAMENTO CAMPOS",
                "text": "ACAMPAMENTO CAMPOS"
            }
        ]
    },
    {
        "municipio": "ITINGA",
        "cod": "3134004",
        "comunidades": [
            {
                "id": "CARRAPATO",
                "text": "CARRAPATO"
            },
            {
                "id": "SAO VICENTE",
                "text": "SAO VICENTE"
            },
            {
                "id": "CAMPINS",
                "text": "CAMPINS"
            },
            {
                "id": "CAMPO BELO",
                "text": "CAMPO BELO"
            },
            {
                "id": "HUMAITA",
                "text": "HUMAITA"
            },
            {
                "id": "PALMITO",
                "text": "PALMITO"
            },
            {
                "id": "PASMADO VENDINHA",
                "text": "PASMADO VENDINHA"
            },
            {
                "id": "AGUA BRANCA",
                "text": "AGUA BRANCA"
            },
            {
                "id": "AGUA FRIA",
                "text": "AGUA FRIA"
            },
            {
                "id": "CAMPO QUEIMADO",
                "text": "CAMPO QUEIMADO"
            },
            {
                "id": "JENIPAPO",
                "text": "JENIPAPO"
            },
            {
                "id": "LAGOA ESCURA",
                "text": "LAGOA ESCURA"
            },
            {
                "id": "LARANJEIRAS",
                "text": "LARANJEIRAS"
            },
            {
                "id": "MARIA PEREIRA",
                "text": "MARIA PEREIRA"
            },
            {
                "id": "CORREGO DOS VEADOS",
                "text": "CORREGO DOS VEADOS"
            },
            {
                "id": "PIAUI",
                "text": "PIAUI"
            },
            {
                "id": "TEIXEIRINHA",
                "text": "TEIXEIRINHA"
            },
            {
                "id": "ITINGUINHA",
                "text": "ITINGUINHA"
            }
        ]
    },
    {
        "municipio": "JANAÚBA",
        "cod": "3135100",
        "comunidades": [
            {
                "id": "JACARE GRANDE",
                "text": "JACARE GRANDE"
            },
            {
                "id": "ANGICO",
                "text": "ANGICO"
            },
            {
                "id": "BAIXA DA CANA",
                "text": "BAIXA DA CANA"
            },
            {
                "id": "MUQUEM",
                "text": "MUQUEM"
            },
            {
                "id": "SIMPLICIO",
                "text": "SIMPLICIO"
            },
            {
                "id": "BARREIRO DE DENTRO",
                "text": "BARREIRO DE DENTRO"
            },
            {
                "id": "BARRERAO",
                "text": "BARRERAO"
            },
            {
                "id": "MAROMBA",
                "text": "MAROMBA"
            },
            {
                "id": "BARROQUINHA",
                "text": "BARROQUINHA"
            },
            {
                "id": "TERRA NOVA",
                "text": "TERRA NOVA"
            },
            {
                "id": "TABOQUINHA",
                "text": "TABOQUINHA"
            },
            {
                "id": "TERRA BRANCA",
                "text": "TERRA BRANCA"
            },
            {
                "id": "CRUZ DAS ALMAS",
                "text": "CRUZ DAS ALMAS"
            },
            {
                "id": "BREJINHO",
                "text": "BREJINHO"
            },
            {
                "id": "FLORESTA",
                "text": "FLORESTA"
            },
            {
                "id": "MANICO",
                "text": "MANICO"
            },
            {
                "id": "CAIÇARA",
                "text": "CAIÇARA"
            },
            {
                "id": "POÇAO VELHO",
                "text": "POÇAO VELHO"
            },
            {
                "id": "POÇAO SANTA CRUZ",
                "text": "POÇAO SANTA CRUZ"
            },
            {
                "id": "LAJEDINHO",
                "text": "LAJEDINHO"
            }

        ]
    },
    {
        "municipio": "JANUÁRIA",
        "cod": "3135209",
        "comunidades": [
            {
                "id": "CATANDUVA",
                "text": "CATANDUVA"
            },
            {
                "id": "MARRECA",
                "text": "MARRECA"
            },
            {
                "id": "UMBURANA",
                "text": "UMBURANA"
            },
            {
                "id": "VARZEA DA CRUZ",
                "text": "VARZEA DA CRUZ"
            },
            {
                "id": "CABECEIRA DE MOCAMBINHO",
                "text": "CABECEIRA DE MOCAMBINHO"
            },
            {
                "id": "ESTIVA",
                "text": "ESTIVA"
            },
            {
                "id": "COCOS",
                "text": "COCOS"
            },
            {
                "id": "BURITIZINHO",
                "text": "BURITIZINHO"
            }
            
        ]
    },
    {
        "municipio": "JEQUITAÍ",
        "cod": "3135605",
        "comunidades": [
            {
                "id": "AGUA SUJA",
                "text": "AGUA SUJA"
            },
            {
                "id": "BURITI DE BAIXO",
                "text": "BURITI DE BAIXO"
            },
            {
                "id": "ESPIGAO DO BREJO",
                "text": "ESPIGAO DO BREJO"
            },
            {
                "id": "QUATIS",
                "text": "QUATIS"
            },
            {
                "id": "BOQUEIRAO",
                "text": "BOQUEIRAO"
            },
            {
                "id": "BURITI DO SANTANA",
                "text": "BURITI DO SANTANA"
            },
            {
                "id": "TERRA VERMELHA",
                "text": "TERRA VERMELHA"
            },
            {
                "id": "PALMEIRA",
                "text": "PALMEIRA"
            },
            {
                "id": "PAU DE FRUTA",
                "text": "PAU DE FRUTA"
            },
            {
                "id": "PITOMBEIRA",
                "text": "PITOMBEIRA"
            },
            {
                "id": "REPARTIMENTO",
                "text": "REPARTIMENTO"
            },
            {
                "id": "ESPINHO",
                "text": "ESPINHO"
            },
            {
                "id": "LAGOAO",
                "text": "LAGOAO"
            },
            {
                "id": "LAVANDERIA",
                "text": "LAVANDERIA"
            }
        ]
    },
    {
        "municipio": "JOSÉ GONÇALVES DE MINAS",
        "cod": "3136520",
        "comunidades": [
            {
                "id": "BARREIRO",
                "text": "BARREIRO"
            },
            {
                "id": "FARINHA SECA /DEPOSITO COMUNITARIO",
                "text": "FARINHA SECA /DEPOSITO COMUNITARIO"
            },
            {
                "id": "LIMEIRA /DEPOSITO COMUNITARIO",
                "text": "LIMEIRA /DEPOSITO COMUNITARIO"
            },
            {
                "id": "CATUTIBA /DEPOSITO COMUNITARIO",
                "text": "CATUTIBA /DEPOSITO COMUNITARIO"
            },
            {
                "id": "CONTENDAS /DEPOSITO COMINITARIO",
                "text": "CONTENDAS /DEPOSITO COMINITARIO"
            },
            {
                "id": "LIMEIRA /CAMPO",
                "text": "LIMEIRA /CAMPO"
            },
            {
                "id": "SAMAMBAIAS",
                "text": "SAMAMBAIAS"
            },
            {
                "id": "SAO BENTO / LAPINHA",
                "text": "SAO BENTO / LAPINHA"
            },
            {
                "id": "PAULINOS",
                "text": "PAULINOS"
            }
        ]
    },
    {
        "municipio": "JURAMENTO",
        "cod": "3136801",
        "comunidades": [
            {
                "id": "BARREIRINHO",
                "text": "BARREIRINHO"
            },
            {
                "id": "BOA VISTA",
                "text": "BOA VISTA"
            },
            {
                "id": "MANDURI",
                "text": "MANDURI"
            },
            {
                "id": "PRATA",
                "text": "PRATA"
            },
            {
                "id": "CAVA DO CURRAL",
                "text": "CAVA DO CURRAL"
            },
            {
                "id": "SANTANA MUNDO NOVO",
                "text": "SANTANA MUNDO NOVO"
            },
            {
                "id": "CAMPO GRANDE",
                "text": "CAMPO GRANDE"
            },
            {
                "id": "PAU DOLEO",
                "text": "PAU DOLEO"
            }
        ]
    },
    {
        "municipio": "JUVENÍLIA",
        "cod": "3136959",
        "comunidades": [
            {
                "id": "PROJETO DE ASSENTAMENTO OURO VERDE",
                "text": "PROJETO DE ASSENTAMENTO OURO VERDE"
            },
            {
                "id": "ASSENTAMENTO PARA TERRA",
                "text": "ASSENTAMENTO PARA TERRA"
            },
            {
                "id": "PROJ, ASSENTAMENTO TREVO",
                "text": "PROJ, ASSENTAMENTO TREVO"
            },
            {
                "id": "PROJ,ASSENTAMENTO GROTA DO ESCURO",
                "text": "PROJ,ASSENTAMENTO GROTA DO ESCURO"
            },
            {
                "id": "COMUNIDADE DE BANANEIRA",
                "text": "COMUNIDADE DE BANANEIRA"
            },
            {
                "id": "PROJ, ASSENTAMENTO DIVIDIDA / TABOLEIRINH",
                "text": "PROJ, ASSENTAMENTO DIVIDIDA / TABOLEIRINH"
            }
        ]
    },
    {
        "munipicipio": "Mamonas",
        "cod": "3139250",
        "comunidades": [
            {
                "id": "BARRA DO SITIO",
                "text": "BARRA DO SITIO"
            },
            {
                "id": "BARREIRO DO MATO",
                "text": "BARREIRO DO MATO"
            },
            {
                "id": "CABECEIRAS",
                "text": "CABECEIRAS"
            },
            {
                "id": "JUNCO",
                "text": "JUNCO"
            },
            {
                "id": "PAUS PRETO",
                "text": "PAUS PRETO"
            },
            {
                "id": "PINHAO",
                "text": "PINHAO"
            },
            {
                "id": "RIACHO FUNDO",
                "text": "RIACHO FUNDO"
            },
            {
                "id": "VARZEA DA CONCEIÇAO",
                "text": "VARZEA DA CONCEIÇAO"
            },
            {
                "id": "CAETANO",
                "text": "CAETANO"
            },
            {
                "id": "CARAIBAS DE CIMA",
                "text": "CARAIBAS DE CIMA"
            },
            {
                "id": "PEDRA REDONDA",
                "text": "PEDRA REDONDA"
            },
            {
                "id": "BARREIRO DA CRUZ",
                "text": "BARREIRO DA CRUZ"
            },
            {
                "id": "HAVANA",
                "text": "HAVANA"
            },
            {
                "id": "LIMOEIRO",
                "text": "LIMOEIRO"
            },
            {
                "id": "MELADA",
                "text": "MELADA"
            },
            {
                "id": "RIACHO DE AREIA",
                "text": "RIACHO DE AREIA"
            }
        ]
    },
    {
        "municipio": "MATO VERDE",
        "cod": "3141009",
        "comunidades": [
            {
                "id": "CORREGO FUNDO",
                "text": "CORREGO FUNDO"
            },
            {
                "id": "BARRA",
                "text": "BARRA"
            },
            {
                "id": "JUREMA",
                "text": "JUREMA"
            },
            {
                "id": "OLHOS D- AGUA 2",
                "text": "OLHOS D- AGUA 2"
            },
            {
                "id": "TANQUINHO",
                "text": "TANQUINHO"
            },
            {
                "id": "CRISTINO II",
                "text": "CRISTINO II"
            },
            {
                "id": "MELANCIAS",
                "text": "MELANCIAS"
            },
            {
                "id": "PAU BRANCO-ALAGADIÇO",
                "text": "PAU BRANCO-ALAGADIÇO"
            },
            {
                "id": "SITIO NOVO",
                "text": "SITIO NOVO"
            }
        ]
    },
    {
        "municipio": "MINAS NOVAS",
        "cod": "3141801",
        "comunidades": [
            {
                "id": "ESTIVA CAMPOS",
                "text": "ESTIVA CAMPOS"
            },
            {
                "id": "CORREGO CATUA",
                "text": "CORREGO CATUA"
            },
            {
                "id": "NOVA ESPERANÇA",
                "text": "NOVA ESPERANÇA"
            },
            {
                "id": "ANGICOS",
                "text": "ANGICOS"
            },
            {
                "id": "CURRAL VELHO",
                "text": "CURRAL VELHO"
            },
            {
                "id": "CURRALINHO",
                "text": "CURRALINHO"
            },
            {
                "id": "SAO JOSE DO CAPIVARI",
                "text": "SAO JOSE DO CAPIVARI"
            },
            {
                "id": "TAMANDUA",
                "text": "TAMANDUA"
            },
            {
                "id": "BEM POSTA DO IMBIRUÇU",
                "text": "BEM POSTA DO IMBIRUÇU"
            },
            {
                "id": "CANSANCAO",
                "text": "CANSANCAO"
            },
            {
                "id": "LAGOINHA",
                "text": "LAGOINHA"
            },
            {
                "id": "BURITI BOA VISTA",
                "text": "BURITI BOA VISTA"
            },
            {
                "id": "CAPELA",
                "text": "CAPELA"
            },
            {
                "id": "GROTA DO RANCHO",
                "text": "GROTA DO RANCHO"
            },
            {
                "id": "MACUCO",
                "text": "MACUCO"
            },
            {
                "id": "PINHEIRO",
                "text": "PINHEIRO"
            },
            {
                "id": "ARAUJO",
                "text": "ARAUJO"
            },
            {
                "id": "FORQUILHA",
                "text": "FORQUILHA"
            },
            {
                "id": "AREIAO",
                "text": "AREIAO"
            },
            {
                "id": "CORREGO DA HELENA",
                "text": "CORREGO DA HELENA"
            },
            {
                "id": "INACIO FELIX",
                "text": "INACIO FELIX"
            }
        ]
    },
    {
        "municipio": "MONTALVÂNIA",
        "cod": "3142700",
        "comunidades": [
            {
                "id": "AGUA BRANCA II",
                "text": "AGUA BRANCA II"
            },
            {
                "id": "JACARE",
                "text": "JACARE"
            },
            {
                "id": "CANOAS I E II",
                "text": "CANOAS I E II"
            },
            {
                "id": "GERGELIM",
                "text": "GERGELIM"
            },
            {
                "id": "SAO JOSE",
                "text": "SAO JOSE"
            },
            {
                "id": "COMUNIDADE DE BURITIZINHO",
                "text": "COMUNIDADE DE BURITIZINHO"
            },
            {
                "id": "AGUA BRANCA I",
                "text": "AGUA BRANCA I"
            },
            {
                "id": "ESPIRITO SANTOS",
                "text": "ESPIRITO SANTOS"
            },
            {
                "id": "FLECHEIRA",
                "text": "FLECHEIRA"
            }
        ]
    },
    {
        "municipio": "MONTE AZUL",
        "cod": "3142908",
        "comunidades": [
            {
                "id": "CACIMBAS",
                "text": "CACIMBAS"
            },
            {
                "id": "ANANAZEIRO",
                "text": "ANANAZEIRO"
            },
            {
                "id": "VALENTE",
                "text": "VALENTE"
            },
            {
                "id": "CAPOEIRA GRANDE",
                "text": "CAPOEIRA GRANDE"
            },
            {
                "id": "LAMDIM",
                "text": "LAMDIM"
            },
            {
                "id": "PAUS PRETRO DE MAMONAS",
                "text": "PAUS PRETRO DE MAMONAS"
            },
            {
                "id": "SAO PEDRO",
                "text": "SAO PEDRO"
            }
        ]
    },
    {
        "municipio": "MONTEZUMA",
        "cod": "3143450",
        "comunidades": [
            {
                "id": "BARREIRO",
                "text": "BARREIRO"
            },
            {
                "id": "LEDRO",
                "text": "LEDRO"
            },
            {
                "id": "VARGEM DAS SALINAS",
                "text": "VARGEM DAS SALINAS"
            },
            {
                "id": "VOLTA DO MORRO",
                "text": "VOLTA DO MORRO"
            },
            {
                "id": "AREIAO",
                "text": "AREIAO"
            },
            {
                "id": "BREJO",
                "text": "BREJO"
            },
            {
                "id": "MARACAIA 2",
                "text": "MARACAIA 2"
            },
            {
                "id": "SAO MODESTO",
                "text": "SAO MODESTO"
            },
            {
                "id": "TABUA",
                "text": "TABUA"
            },
            {
                "id": "CERCADO",
                "text": "CERCADO"
            },
            {
                "id": "ESTIVA",
                "text": "ESTIVA"
            },
            {
                "id": "MANDACARU",
                "text": "MANDACARU"
            },
            {
                "id": "MARACAIA 1",
                "text": "MARACAIA 1"
            },
            {
                "id": "SAO BARTOLOMEU 1",
                "text": "SAO BARTOLOMEU 1"
            },
            {
                "id": "SAO BARTOLOMEU 2",
                "text": "SAO BARTOLOMEU 2"
            }
        ]
    },
    {
        "municipio": "NINHEIRA",
        "cod": "3144656",
        "comunidades": [
            {
                "id": "BOA VISTA",
                "text": "BOA VISTA"
            },
            {
                "id": "LAGOINHA",
                "text": "LAGOINHA"
            },
            {
                "id": "SOSSEGO",
                "text": "SOSSEGO"
            },
            {
                "id": "BAIXA NOVA",
                "text": "BAIXA NOVA"
            },
            {
                "id": "MORRO DO OURO",
                "text": "MORRO DO OURO"
            },
            {
                "id": "BAIXAO",
                "text": "BAIXAO"
            },
            {
                "id": "LAGOA DE FORA",
                "text": "LAGOA DE FORA"
            },
            {
                "id": "ALAGADIÇO",
                "text": "ALAGADIÇO"
            },
            {
                "id": "LAGOA DO CEDRO",
                "text": "LAGOA DO CEDRO"
            }
        ]
    },
    {
        "municipio": "PAI PEDRO",
        "cod": "3146552",
        "comunidades": [
            {
                "id": "BARRA DO PACUI",
                "text": "BARRA DO PACUI"
            },
            {
                "id": "PICADA",
                "text": "PICADA"
            },
            {
                "id": "P,A,SANTA CLAUDIA",
                "text": "P,A,SANTA CLAUDIA"
            },
            {
                "id": "SALINAS V",
                "text": "SALINAS V"
            },
            {
                "id": "BELA VISTA",
                "text": "BELA VISTA"
            },
            {
                "id": "TAPERINHA",
                "text": "TAPERINHA"
            },
            {
                "id": "CANA BOLSA",
                "text": "CANA BOLSA"
            },
            {
                "id": "LAGOA VERDE",
                "text": "LAGOA VERDE"
            },
            {
                "id": "SALINAS BEIRA RIO",
                "text": "SALINAS BEIRA RIO"
            },
            {
                "id": "ATRAS DOS MORROS",
                "text": "ATRAS DOS MORROS"
            },
            {
                "id": "TABUA II",
                "text": "TABUA II"
            },
            {
                "id": "SERRA GRANDE",
                "text": "SERRA GRANDE"
            },
            {
                "id": "TABUA I",
                "text": "TABUA I"
            },
            {
                "id": "VARZEA DAS PEDRAS",
                "text": "VARZEA DAS PEDRAS"
            }
        ]
    },
    {
        "municipio": "PEDRAS DE MARIA DA CRUZ",
        "cod": "3149150",
        "comunidades": [
            {
                "id": "BOI MATEUS",
                "text": "BOI MATEUS"
            },
            {
                "id": "EXTREMA",
                "text": "EXTREMA"
            },
            {
                "id": "POÇAOZINHO",
                "text": "POÇAOZINHO"
            },
            {
                "id": "CORCUNDO",
                "text": "CORCUNDO"
            },
            {
                "id": "MANGAI",
                "text": "MANGAI"
            },
            {
                "id": "MORRO DO CHAPEU",
                "text": "MORRO DO CHAPEU"
            },
            {
                "id": "BARREIRO CERCADO",
                "text": "BARREIRO CERCADO"
            },
            {
                "id": "COM,DEUS VENCEREMOS",
                "text": "COM,DEUS VENCEREMOS"
            },
            {
                "id": "LAGOINHA",
                "text": "LAGOINHA"
            },
            {
                "id": "RIACHO DO BURITI",
                "text": "RIACHO DO BURITI"
            },
            {
                "id": "TORROES",
                "text": "TORROES"
            },
            {
                "id": "BAIXA D AGUA",
                "text": "BAIXA D AGUA"
            },
            {
                "id": "BOM SUCESSO",
                "text": "BOM SUCESSO"
            },
            {
                "id": "ARAME LISO",
                "text": "ARAME LISO"
            },
            {
                "id": "PADILHO",
                "text": "PADILHO"
            },
            {
                "id": "PALMEIRINHA",
                "text": "PALMEIRINHA"
            }
        ]
    },
    {
        "municipio": "PINTÓPOLIS",
        "cod": "3150570",
        "comunidades": [
            {
                "id": "BARREIRINHO",
                "text": "BARREIRINHO"
            },
            {
                "id": "ACARI",
                "text": "ACARI"
            },
            {
                "id": "ALEGRE",
                "text": "ALEGRE"
            },
            {
                "id": "ALVORADA",
                "text": "ALVORADA"
            },
            {
                "id": "JATOBA",
                "text": "JATOBA"
            },
            {
                "id": "LAVANDEIRA",
                "text": "LAVANDEIRA"
            },
            {
                "id": "PARA TERRA II",
                "text": "PARA TERRA II"
            },
            {
                "id": "PARA TERRA III",
                "text": "PARA TERRA III"
            },
            {
                "id": "SUSSUARANA",
                "text": "SUSSUARANA"
            },
            {
                "id": "VARGEM DE CANOAS",
                "text": "VARGEM DE CANOAS"
            },
            {
                "id": "VIEIRA",
                "text": "VIEIRA"
            },
            {
                "id": "CAPIM PUBO",
                "text": "CAPIM PUBO"
            },
            {
                "id": "QUATIS",
                "text": "QUATIS"
            }
        ]
    },
    {
        "municipio": "PIRAPORA",
        "cod": "3151206",
        "comunidades": [
            {
                "id": "ASSENTAMENTO JOSE BANDEIRA",
                "text": "ASSENTAMENTO JOSE BANDEIRA"
            }
        ]
    },
    {
        "municipio": "PONTO CHIQUE",
        "cod": "3152131",
        "comunidades": [
            {
                "id": "CARAIBAS",
                "text": "CARAIBAS"
            },
            {
                "id": "RUSSAO",
                "text": "RUSSAO"
            },
            {
                "id": "TANQUE",
                "text": "TANQUE"
            },
            {
                "id": "BOM JARDIM",
                "text": "BOM JARDIM"
            }
        ]
    },
    {
        "municipio": "PORTEIRINHA",
        "cod": "3152204",
        "comunidades": [
            {
                "id": "BARREIRO I",
                "text": "BARREIRO I"
            },
            {
                "id": "GERAISINHO",
                "text": "GERAISINHO"
            },
            {
                "id": "POCO GRANDE",
                "text": "POCO GRANDE"
            },
            {
                "id": "GANGORRA",
                "text": "GANGORRA"
            },
            {
                "id": "EXTREMA",
                "text": "EXTREMA"
            },
            {
                "id": "OLHOS DÁGUA DE CIMA",
                "text": "OLHOS DÁGUA DE CIMA"
            },
            {
                "id": "POCO DANTAS",
                "text": "POCO DANTAS"
            },
            {
                "id": "CALDEIRAOZINHO",
                "text": "CALDEIRAOZINHO"
            },
            {
                "id": "CEDRO",
                "text": "CEDRO"
            },
            {
                "id": "COCOS (RIO DOS COCOS)",
                "text": "COCOS (RIO DOS COCOS)"
            },
            {
                "id": "LAGOINHA",
                "text": "LAGOINHA"
            },
            {
                "id": "MALHADA DOS BOIS",
                "text": "MALHADA DOS BOIS"
            },
            {
                "id": "PAJEU I",
                "text": "PAJEU I"
            },
            {
                "id": "PARA I",
                "text": "PARA I"
            },
            {
                "id": "CARRASCAO",
                "text": "CARRASCAO"
            },
            {
                "id": "MALHADA BONITA",
                "text": "MALHADA BONITA"
            },
            {
                "id": "MUGANGA",
                "text": "MUGANGA"
            },
            {
                "id": "MUMBUCA",
                "text": "MUMBUCA"
            },
            {
                "id": "NOVO TANQUE",
                "text": "NOVO TANQUE"
            }
        ]
    },
    {
        "municipio": "RUBIM",
        "cod": "3156601",
        "comunidades": [
            {
                "id": "DUAS BARRAS",
                "text": "DUAS BARRAS"
            },
            {
                "id": "MIRANTES",
                "text": "MIRANTES"
            },
            {
                "id": "REVOLTA",
                "text": "REVOLTA"
            },
            {
                "id": "PEDRA PARDA",
                "text": "PEDRA PARDA"
            },
            {
                "id": "ASSENTAMENTO JERUSALEM",
                "text": "ASSENTAMENTO JERUSALEM"
            }
        ]
    },
    {
        "municipio": "SANTA CRUZ DE SALINAS",
        "cod": "3157377",
        "comunidades": [
            {
                "id": "CORREGO DO MEIO",
                "text": "CORREGO DO MEIO"
            },
            {
                "id": "CORREGO DOS BREJOS",
                "text": "CORREGO DOS BREJOS"
            },
            {
                "id": "ITINGUINHA E BARRA DA VEREDA",
                "text": "ITINGUINHA E BARRA DA VEREDA"
            },
            {
                "id": "PINDAIBA",
                "text": "PINDAIBA"
            },
            {
                "id": "SAO JOSE DA BOA VISTA",
                "text": "SAO JOSE DA BOA VISTA"
            },
            {
                "id": "BRASAMUNDO II",
                "text": "BRASAMUNDO II"
            },
            {
                "id": "BREJINHO",
                "text": "BREJINHO"
            },
            {
                "id": "CURRAL VELHO",
                "text": "CURRAL VELHO"
            },
            {
                "id": "TOME",
                "text": "TOME"
            },
            {
                "id": "TRACADAL",
                "text": "TRACADAL"
            },
            {
                "id": "BRASAMUNDO I",
                "text": "BRASAMUNDO I"
            },
            {
                "id": "CARRETAO",
                "text": "CARRETAO"
            },
            {
                "id": "SAO FELIX",
                "text": "SAO FELIX"
            },
            {
                "id": "VEREDA",
                "text": "VEREDA"
            },
            {
                "id": "PEDRA REDONDA I E II",
                "text": "PEDRA REDONDA I E II"
            }
        ]
    },
    {
        "municipio": "SANTA FÉ DE MINAS",
        "cod": "3157609",
        "comunidades": [
            {
                "id": "LAVADO",
                "text": "LAVADO"
            },
            {
                "id": "P,A, TAMBORIL",
                "text": "P,A, TAMBORIL"
            },
            {
                "id": "VARZEA ALEGRE",
                "text": "VARZEA ALEGRE"
            }
        ]
    },
    {
        "municipio": "SÃO JOÃO DAS MISSÕES",
        "cod": "3162450",
        "comunidades": [
            {
                "id": "ALDEIA PINDAIBA",
                "text": "ALDEIA PINDAIBA"
            },
            {
                "id": "ALDEIA RIACHO DOS BURITIS",
                "text": "ALDEIA RIACHO DOS BURITIS"
            },
            {
                "id": "ALDEIA BARREIRO PRETO",
                "text": "ALDEIA BARREIRO PRETO"
            },
            {
                "id": "ALDEIA SANTA CRUZ",
                "text": "ALDEIA SANTA CRUZ"
            },
            {
                "id": "ALDEIA RIACHO DO BREJO",
                "text": "ALDEIA RIACHO DO BREJO"
            },
            {
                "id": "ALDEIA SAO DOMINGOS",
                "text": "ALDEIA SAO DOMINGOS"
            },
            {
                "id": "ALDEIA TERRA PRETA",
                "text": "ALDEIA TERRA PRETA"
            },
            {
                "id": "ALDEIA CUSTODIO",
                "text": "ALDEIA CUSTODIO"
            },
            {
                "id": "ALDEIA PRATA",
                "text": "ALDEIA PRATA"
            },
            {
                "id": "ALDEIAS PEDRINHAS",
                "text": "ALDEIAS PEDRINHAS"
            }
        ]
    },
    {
        "municipio": "TAIOBEIRAS",
        "cod": "3168002",
        "comunidades": [
            {
                "id": "NOVATO",
                "text": "NOVATO"
            },
            {
                "id": "CERCADO",
                "text": "CERCADO"
            },
            {
                "id": "MARIANTE",
                "text": "MARIANTE"
            },
            {
                "id": "OLHOS DAGUA",
                "text": "OLHOS DAGUA"
            },
            {
                "id": "MANTEIGA",
                "text": "MANTEIGA"
            },
            {
                "id": "TABUA",
                "text": "TABUA"
            },
            {
                "id": "LAGOA DOURADA",
                "text": "LAGOA DOURADA"
            },
            {
                "id": "LAGOA GRANDE",
                "text": "LAGOA GRANDE"
            },
            {
                "id": "MARRUAZ",
                "text": "MARRUAZ"
            },
            {
                "id": "MATRONA",
                "text": "MATRONA"
            },
            {
                "id": "MATRONA",
                "text": "MATRONA"
            },
            {
                "id": "LAJEDO",
                "text": "LAJEDO"
            },
            {
                "id": "GAMELEIRA",
                "text": "GAMELEIRA"
            },
            {
                "id": "RIBEIRAO",
                "text": "RIBEIRAO"
            }
        ]
    },
    {
        "municipio": "UBAÍ",
        "cod": "3170008",
        "comunidades": [
            {
                "id": "TOURO",
                "text": "TOURO"
            },
            {
                "id": "AREIAO",
                "text": "AREIAO"
            },
            {
                "id": "CANOAS",
                "text": "CANOAS"
            },
            {
                "id": "ENGENHO",
                "text": "ENGENHO"
            },
            {
                "id": "SERRAGEM",
                "text": "SERRAGEM"
            },
            {
                "id": "VEREDA",
                "text": "VEREDA"
            },
            {
                "id": "CABECEIRA DA BANANEIRA",
                "text": "CABECEIRA DA BANANEIRA"
            },
            {
                "id": "SALTO",
                "text": "SALTO"
            },
            {
                "id": "BREJÃO",
                "text": "BREJÃO"
            },
            {
                "id": "BURITIS",
                "text": "BURITIS"
            },
            {
                "id": "COQUEIRO",
                "text": "COQUEIRO"
            },
            {
                "id": "ESBARRANCADO",
                "text": "ESBARRANCADO"
            },
            {
                "id": "GAMELEIRAS",
                "text": "GAMELEIRAS"
            },
            {
                "id": "PASSAGEM BRANCA",
                "text": "PASSAGEM BRANCA"
            },
            {
                "id": "AGROVILA",
                "text": "AGROVILA"
            },
            {
                "id": "EXTREMA",
                "text": "EXTREMA"
            }
        ]
    },
    {
        "municipio": "URUCUIA",
        "cod": "3170529",
        "comunidades": [
            {
                "id": "BOA SORTE",
                "text": "BOA SORTE"
            },
            {
                "id": "CACHOEIRA",
                "text": "CACHOEIRA"
            },
            {
                "id": "MORRINHOS",
                "text": "MORRINHOS"
            },
            {
                "id": "POÇOES",
                "text": "POÇOES"
            },
            {
                "id": "VEREDA GRANDE",
                "text": "VEREDA GRANDE"
            },
            {
                "id": "MATAO",
                "text": "MATAO"
            },
            {
                "id": "OLARIA",
                "text": "OLARIA"
            },
            {
                "id": "BONITO",
                "text": "BONITO"
            },
            {
                "id": "PEDRAS",
                "text": "PEDRAS"
            },
            {
                "id": "JUDAS",
                "text": "JUDAS"
            },
            {
                "id": "MIAO",
                "text": "MIAO"
            },
            {
                "id": "GAMELEIRA",
                "text": "GAMELEIRA"
            }
        ]
    },
    {
        "municipio": "VARGEM GRANDE DO RIO PARDO",
        "cod": "3170651",
        "comunidades": [
            {
                "id": "BRACO ESQUERDO",
                "text": "BRACO ESQUERDO"
            },
            {
                "id": "ENGENHO",
                "text": "ENGENHO"
            },
            {
                "id": "FAZENDA COCOS",
                "text": "FAZENDA COCOS"
            },
            {
                "id": "FAZENDA PAIAIA",
                "text": "FAZENDA PAIAIA"
            },
            {
                "id": "GAMELAS",
                "text": "GAMELAS"
            },
            {
                "id": "MATO ESCURO I",
                "text": "MATO ESCURO I"
            },
            {
                "id": "SITIO NOVO",
                "text": "SITIO NOVO"
            },
            {
                "id": "AGUA FRIA",
                "text": "AGUA FRIA"
            },
            {
                "id": "BURACOS",
                "text": "BURACOS"
            },
            {
                "id": "CACHOEIRA I",
                "text": "CACHOEIRA I"
            },
            {
                "id": "CACHOEIRA II",
                "text": "CACHOEIRA II"
            },
            {
                "id": "CANTINHO",
                "text": "CANTINHO"
            },
            {
                "id": "CATANDUVA",
                "text": "CATANDUVA"
            },
            {
                "id": "FAZENDA BREJO",
                "text": "FAZENDA BREJO"
            },
            {
                "id": "ASSENTAMENTO",
                "text": "ASSENTAMENTO"
            }
        ]
    },
    {
        "municipio": "VÁRZEA DA PALMA",
        "cod": "3170800",
        "comunidades": [
            {
                "id": "ASSENT, MAE D AGUA",
                "text": "ASSENT, MAE D AGUA"
            },
            {
                "id": "BANANAL DE CIMA",
                "text": "BANANAL DE CIMA"
            },
            {
                "id": "CACHOEIRA ANGICAL",
                "text": "CACHOEIRA ANGICAL"
            },
            {
                "id": "COMUNID, BOM JARDIM",
                "text": "COMUNID, BOM JARDIM"
            },
            {
                "id": "COMUNID,TAMBORIL",
                "text": "COMUNID,TAMBORIL"
            },
            {
                "id": "ASSENT, ROMPE DIA ",
                "text": "ASSENT, ROMPE DIA"
            }
        ]
    },
    {
        "municipio": "VARZELÂNDIA",
        "cod": "3170909",
        "comunidades": [
            {
                "id": "SERRA D AGUA",
                "text": "SERRA D AGUA"
            },
            {
                "id": "BARREIRO AZUL",
                "text": "BARREIRO AZUL"
            },
            {
                "id": "ORION",
                "text": "ORION"
            },
            {
                "id": "TABUAL DE BAIXO",
                "text": "TABUAL DE BAIXO"
            },
            {
                "id": "LAGOINHA I",
                "text": "LAGOINHA I"
            },
            {
                "id": "LAGOINHA II",
                "text": "LAGOINHA II"
            }
        ]
    },
    {
        "municipio": "VERDELÂNDIA",
        "cod": "3171030",
        "comunidades": [
            {
                "id": "RESSACA",
                "text": "RESSACA"
            },
            {
                "id": "BOM SUCESSO",
                "text": "BOM SUCESSO"
            },
            {
                "id": "CORGAO",
                "text": "CORGAO"
            },
            {
                "id": "MATA NOVA",
                "text": "MATA NOVA"
            },
            {
                "id": "BOM JARDIM",
                "text": "BOM JARDIM"
            },
            {
                "id": "LAGOA DE PEDRA",
                "text": "LAGOA DE PEDRA"
            },
            {
                "id": "LIMEIRA",
                "text": "LIMEIRA"
            },
            {
                "id": "SERRANA",
                "text": "SERRANA"
            },
            {
                "id": "VOLTA DA SERRA",
                "text": "VOLTA DA SERRA"
            },
            {
                "id": "SAPE",
                "text": "SAPE"
            },
            {
                "id": "AMARGOSO",
                "text": "AMARGOSO"
            },
            {
                "id": "VITORIA",
                "text": "VITORIA"
            }
        ]
    },
    {
        "municipio": "VEREDINHA",
        "cod": "3171071",
        "comunidades": [
            {
                "id": "SANTO ANTONIO",
                "text": "SANTO ANTONIO"
            },
            {
                "id": "SUCAVAO",
                "text": "SUCAVAO"
            },
            {
                "id": "GROTA DO ENGENHO",
                "text": "GROTA DO ENGENHO"
            },
            {
                "id": "LAJES",
                "text": "LAJES"
            },
            {
                "id": "MIRANTE",
                "text": "MIRANTE"
            },
            {
                "id": "BOIADA 2",
                "text": "BOIADA 2"
            },
            {
                "id": "CURTUME",
                "text": "CURTUME"
            },
            {
                "id": "MACAUBAS",
                "text": "MACAUBAS"
            },
            {
                "id": "MONTE ALEGRE",
                "text": "MONTE ALEGRE"
            },
            {
                "id": "CAQUENTE",
                "text": "CAQUENTE"
            },
            {
                "id": "CORREGO DO OURO",
                "text": "CORREGO DO OURO"
            },
            {
                "id": "TENDAS",
                "text": "TENDAS"
            },
            {
                "id": "RIBEIRAO VEREDINHA",
                "text": "RIBEIRAO VEREDINHA"
            },
            {
                "id": "ATOLEIRO",
                "text": "ATOLEIRO"
            },
            {
                "id": "GAMELEIRA",
                "text": "GAMELEIRA"
            },
            {
                "id": "RIBEIRAO DAS POSSES",
                "text": "RIBEIRAO DAS POSSES"
            }
        ]
    },
    {
        "municipio": "VIRGEM DA LAPA",
        "cod": "3171600",
        "comunidades": [
            {
                "id": "MORRINHOS",
                "text": "MORRINHOS"
            },
            {
                "id": "BUGRE",
                "text": "BUGRE"
            },
            {
                "id": "BELA VISTA (SANTANA)",
                "text": "BELA VISTA (SANTANA)"
            },
            {
                "id": "COQUEIROS",
                "text": "COQUEIROS"
            },
            {
                "id": "CURRAL NOVO",
                "text": "CURRAL NOVO"
            },
            {
                "id": "LAGOA DA MANGA",
                "text": "LAGOA DA MANGA"
            },
            {
                "id": "TAMANDUA",
                "text": "TAMANDUA"
            },
            {
                "id": "BURITI",
                "text": "BURITI"
            },
            {
                "id": "JEQUITIBA",
                "text": "JEQUITIBA"
            },
            {
                "id": "MALHADA BRANCA",
                "text": "MALHADA BRANCA"
            },
            {
                "id": "MASSACARA",
                "text": "MASSACARA"
            },
            {
                "id": "OURO FINO",
                "text": "OURO FINO"
            },
            {
                "id": "PAREDAO",
                "text": "PAREDAO"
            },
            {
                "id": "VAI VI",
                "text": "VAI VI"
            },
            {
                "id": "ALMAS",
                "text": "ALMAS"
            },
            {
                "id": "BARBOSA",
                "text": "BARBOSA"
            },
            {
                "id": "BURU",
                "text": "BURU"
            },
            {
                "id": "CHACARA",
                "text": "CHACARA"
            },
            {
                "id": "GRAVATA",
                "text": "GRAVATA"
            },
            {
                "id": "ONÇA",
                "text": "ONÇA"
            },
            {
                "id": "ROSARIO DE CIMA",
                "text": "ROSARIO DE CIMA"
            },
            {
                "id": "SAO JOSE",
                "text": "SAO JOSE"
            }
        ]
    }
]';

        $municipios = Municipio::all();
        return view(
            'ajuda/cisterna/create',
            [
                'municipios' => $municipios,
                'comunidades' => $comunidades,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dd($request);
        // Validação 

        // Gravar

        // Fotos 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ajuda\Cisterna  $cisterna
     * @return \Illuminate\Http\Response
     */
    public function show(Cisterna $cisterna)
    {

        $dados = Cisterna::with('getMunicipio')
            ->where('id', $cisterna->id)
            ->first();

        $cpf = str_replace([".", "-"], "", $cisterna->cpf);

        $images = Storage::files('cisterna/' . $cpf, true);

        return view(
            'ajuda/cisterna/view',
            [
                'cisterna' => $dados,
                'images' => $images,

            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajuda\Cisterna  $cisterna
     * @return \Illuminate\Http\Response
     */
    public function edit(Cisterna $cisterna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajuda\Cisterna  $cisterna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cisterna $cisterna)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajuda\Cisterna  $cisterna
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cisterna $cisterna)
    {
        //
    }

    public function exportAllExcel()
    {
        return Excel::download(new ExportCisterna, 'Dados_app' . date('d_m_Y_H.i.s') . '.xlsx');
    }
}
