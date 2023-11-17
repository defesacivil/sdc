<?php
/**
 *  nome / tipo do ponto de captação
 */
function pmda_tipo_ponto($tipo){
    
    switch ($tipo) {
        case '1':
            return "COPASA";
            break;
        case '2':
            return "COPANOR";
            break;
        case '3':
            return "BARRAGEM";
            break;
        case '4':
            return "SAAE/DMAE";
            break;
        case '5':
            return "POÇO ARTESIANO PÚBLICO";
            break;
        case '6':
            return "POÇO ARTESIANO PARTICULAR";
            break;        
        default:
            # code...
            break;
    }
    
}

   