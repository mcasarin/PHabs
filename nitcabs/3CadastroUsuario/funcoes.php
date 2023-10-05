<?php
function monta_select($campo, $start, $end) {
        $select = "<select name=\"$campo\" id=\"$campo\">\n";
        for($i = $start; $i <= $end; $i++) {                    
                $select .= "\t<option value=\"". sprintf("%02d", $i) ."\">".sprintf("%02d", $i)."</option>\n";  
        }                                                       
                $select .= "</select>\n";
        return $select; 
}       

function monta_combo($campo) {
        if($campo == "") {
                return false;
        }
        $select = "<select name=\"campo\">\n";
        for($i = 0; $i < count($campo); $i++) {                 
                $select .= "\t<option value=\"$i\">{$campo[$i]}</option>\n";    
        }                                                       
                $select .= "</select>\n";
        return $select; 
}

function Pega_tipoprojeto($campo) {
        $campo = explode(",", $campo);
        for($i = 0; $i < count($campo); $i++) {
                switch ($campo[$i]) {
                        case "Pesquisa":
                                $tipoprojeto[] = "Pesquisa";           
                                break;
                        case "Evento":
                                $tipoprojeto[] = "Evento";           
                                break;                        
                        case "Curso Presencial":
                                $graduacao[] = "Curso Presencial";            
                                break;
                        case "Curso a distancia":
                                $graduacao[] = "Curso a distancia";           
                                break;
                        }
        }
        return isset($graduacao) ? $graduacao : false;
}

function moeda($get_valor) {
					$source = array('.', ','); 
               $replace = array('', '.');
               $mandabd = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
               return $mandabd; //retorna o valor formatado para gravar no banco
}