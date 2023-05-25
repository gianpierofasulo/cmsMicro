<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//INIZIO DI UNA OPERAZIONE DI TRASFERIMENTO JSON FROM MACHINE
        // Controllo dati utente
        require_once('../../app/class/class_log_operazioni.php');
        require_once('read_jwt.php');

  
        $all_headers = getallheaders();

        $data->JWT = $all_headers['Authorization'];

        $dati_JWT = controlla_jwt($data->JWT);

       if ( $dati_JWT['status'] == 1 ) {
                
            // TUTTO OK
            $ip_client = $_SERVER['REMOTE_ADDR'];
            $endpoint_richiamato =  $_SERVER['REQUEST_URI'];
            $id_utente = $dati_JWT['user_data']->data->id;
            $matricola_macchina = filter_input(INPUT_GET, 'matr', FILTER_SANITIZE_SPECIAL_CHARS );
           
        
           $operazione = new LogOperazioni;
           
            $start_operazione =  $operazione->start_operazione( $id_utente, $ip_client, $endpoint_richiamato, $matricola_macchina, $JSON);
         
        
        if ($start_operazione) {
            // PROSEGUI
            
            $content[] = $dati_catalogo;
            
             echo json_encode($content);
        }

       } else {
        // ERRORE JWT
            $content[0]['datiJWT'] = $dati_JWT;
       }
    
       
   

//}


