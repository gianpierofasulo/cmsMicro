<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//RICERCA DI TUTTI I PRODOTTI DI UN ESERCENTE IN BASE  ALLA MATICOLA DI MACCHINA  
        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');
    
        $id_esercente = filter_input(INPUT_GET, 'id_esercente', FILTER_SANITIZE_NUMBER_INT );
        $id_macchina = filter_input(INPUT_GET, 'id_macchina', FILTER_SANITIZE_NUMBER_INT ); 
        $id_vetrina = filter_input(INPUT_GET, 'id_vetrina', FILTER_SANITIZE_SPECIAL_CHARS ); 
        

        $prodotti = new Prodotto;
       
      
       $dati_catalogo =  $prodotti->elenco_vetrina_digitale($id_esercente, $id_macchina, $id_vetrina);
      
    
    
    if ($dati_catalogo) {
        
        
        // Creo la directory se non esistente
       /*  if ( !file_exists( '../jsontomachine/catalogogenerale.json' )) {
            mkdir( '../jsontomachine/jsontomachine/catalogogenerale.json' , 0777, true);
        } */

        // scrivo file JSON CATALOGO ESERCENTE DI QUELLA MACCHINA
       /*  if ( file_put_contents( '../jsontomachine/catalogogenerale.json', json_encode($dati_catalgo))) {
                 // to client
                    echo json_encode($dati_catalgo);
            }
            else { 
                echo "Oops! Error creating json file...";
            } */

            echo json_encode($dati_catalogo);
    }

//}


