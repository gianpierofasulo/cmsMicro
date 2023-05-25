<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//LISTA CANALI ABILITATI I BASE A ID ESERCENTE E ID MACCHINA  
        // Controllo dati utente
        require_once('../../app/class/class_log_operazioni.php');
     

        $operazione = new LogOperazioni;
           
        $json =  $operazione->leggi_json();
        
        
        if ($json) {

                    
            
                 //  $dati = json_decode($json);
                   $dati = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json) );
                   echo json_encode( var_dump($json) );
                   echo  $json[0]['json_file'] ;
           }
           else { 
               echo "Errore creazione file JSON ".$matricola;
           }
      

            
      
       
       




