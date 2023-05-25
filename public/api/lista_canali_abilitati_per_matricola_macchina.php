<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//LISTA CANALI ABILITATI I BASE A ID ESERCENTE E ID MACCHINA  
        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');
        require_once('read_jwt.php');

  
        $all_headers = getallheaders();
    
        //    $data->JWT = $all_headers['Authorization'];
    
        //   $dati_JWT = controlla_jwt($data->JWT);
    
        //   if ( $dati_JWT['status'] == 1 ) {

            $id_esercente = filter_input(INPUT_GET, 'ide', FILTER_SANITIZE_NUMBER_INT );
       
            $matricola = filter_input(INPUT_GET, 'matr', FILTER_SANITIZE_SPECIAL_CHARS );
      
        
           $prodotti = new Prodotto;
           
          
               $dati_prodotto =  $prodotti->lista_canali_abilitati_per_matricola_macchina( $id_esercente, $matricola);
          
               echo json_encode($dati_prodotto);
               
        // VECCHIO JSON
      /*   if ($dati_prodotto) {
            
              // Creo la directory se non esistente
            if ( !file_exists( '../jsontomachine/listaCanaliAbilitati/'.$matricola )) {
                mkdir( '../jsontomachine/listaCanaliAbilitati/'.$matricola , 0777, true);
    
            }
            if ( file_put_contents( '../jsontomachine/listaCanaliAbilitati/'.$matricola.'/lista_canali_abilitati.json' , json_encode($dati_prodotto))) {
                // to client
                   echo json_encode($dati_prodotto);
           }
           else { 
               echo "Errore creazione file JSON lista_canali_abilitati per la matricola ".$matricola;
           }
        } */

            
     
       
       




