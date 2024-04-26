<?php
/**
 * 
 */
function status_pedido_ah($status){

    switch ($status) {
        case '0':
            return "Edição Compdec";
            break;
        case '1':
            return "Análise DSH";
            break;
        case '2':
            return "Análise Diretor DSH";
            break;
        case '3':
            return "Aprovado";
            break;
        case '4':
            return "Aguardando Disponibilidade Mat.";
            break;
        case '5':
            return "Aguardando Retirada Mat.";
            break;
        case '6':
            return "Atendido";
            break;
        case '7':
            return "Cancelado";
            break;
        case '8':
            return "Reprovado";
            break;
        case '9':
            return "Processo Finalizado";
            break;
        
        default:
            # code...
            break;
    }
    
}

    function statusPmda($status){

            switch ($status) {
                case 0:
                    return "Em Edição";
                    break;
                case 1:
                    return "Completo";
                    break;
                case 2:
                    return "Em Análise";
                    break;
                case 3:
                    return "Arquivado";
                    break;
                case 4:
                    return "Aprovado";
                    break;
                case 5:
                    return "Anulado";
                    break;
                case 9:
                    return "Encerrado";
                    break;
                case 6:
                    return "nulo";
                    break;
                case 7:
                    return "Atendido";
                    break;
                case 8:
                    return "Cancelado";
                    break;
                default:
                    return "opção Inválida !";
                    break;
            }


    }
    

