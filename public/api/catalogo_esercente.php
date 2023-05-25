<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//RICERCA SUL CATALOGO ESERCENTE IN BASE A ID_ESERCETE, ID_MACCHINA, ID_PRDOTTO 
        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');
        require_once('read_jwt.php');

  
    $all_headers = getallheaders();

    $data->JWT = $all_headers['Authorization'];

       $dati_JWT = controlla_jwt($data->JWT);

       if ( $dati_JWT['status'] == 1 ) {
        // TUTTO OK
       

            $id_esercente = filter_input(INPUT_GET, 'ide', FILTER_SANITIZE_NUMBER_INT );
            $id_macchina = filter_input(INPUT_GET, 'idm', FILTER_SANITIZE_NUMBER_INT );
            $id_prodotto = filter_input(INPUT_GET, 'idp', FILTER_SANITIZE_NUMBER_INT );
      
        
           $prodotti = new Prodotto;
           
           if ($id_esercente) {
                $dati_catalogo =  $prodotti->elenco_catalogo_per_esercente($id_esercente);
           }  else if ($id_macchina) {
               $dati_catalogo =  $prodotti->elenco_catalogo_per_macchina($id_macchina);
           }  else if ($id_prodotto) {
               $dati_catalogo =  $prodotti->elenco_catalogo_per_prodotto($id_prodotto);
           }
           
           else {
               $dati_catalogo =  $prodotti->elenco_catalogo_esercente();
           }
        
        
        if ($dati_catalogo) {
            
            $content[] = $dati_catalogo;
            
             echo json_encode($content);
        }

       } else {
        // ERRORE JWT
            $content[0]['datiJWT'] = $dati_JWT;
       }
    
       
   

//}


