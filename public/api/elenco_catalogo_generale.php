<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//RICERCA DI TUTTI I PRODOTTI DI UN ESERCENTE IN BASE  ALLA MATICOLA DI MACCHINA  
        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');
    
        $id_tipologia = filter_input(INPUT_GET, 'idtipo', FILTER_SANITIZE_NUMBER_INT ); 
       $prodotti = new Prodotto;
       
      
       $dati_catalgo =  $prodotti->elenco_catalogo_generale($id_tipologia);
      
    
    
    if ($dati_catalgo) {
        
       // $content[] = $dati_catalgo;

        // Creo la directory se non esistente
       /*  if ( !file_exists( '../jsontomachine/catalogogenerale.json' )) {
            mkdir( '../jsontomachine/jsontomachine/catalogogenerale.json' , 0777, true);
        } */

        // scrivo file JSON CATALOGO ESERCENTE DI QUELLA MACCHINA
        if ( file_put_contents( '../jsontomachine/catalogogenerale.json', json_encode($dati_catalgo))) {
                 // to client
                    echo json_encode($dati_catalgo);
            }
            else { 
                echo "Oops! Error creating json file...";
            }

        
    }

//}


