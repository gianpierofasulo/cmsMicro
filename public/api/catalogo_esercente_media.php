<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//RICERCA MEDIA ESERCENTE IN BASE A ID_ESERCETE 
        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');
        require_once('read_jwt.php');

  
    $all_headers = getallheaders();

    $data->JWT = $all_headers['Authorization'];

       $dati_JWT = controlla_jwt($data->JWT);

       if ( $dati_JWT['status'] == 1 ) {
        // TUTTO OK
        //    $content[0]['datiJWT'] = 'OK';

            $id_esercente = filter_input(INPUT_GET, 'ide', FILTER_SANITIZE_NUMBER_INT );
          
        
           $media = new Prodotto;
           
          
               $dati_media =  $prodotti->elenco_catalogo_esercente();
        
        if ($dati_catalogo) {
            
            $content[] = $dati_catalogo;
            
             echo json_encode($content);
        }

       } else {
        // ERRORE JWT
            $content[0]['datiJWT'] = $dati_JWT;
       }
    
       
   

//}


