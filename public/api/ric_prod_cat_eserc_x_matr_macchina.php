<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//RICERCA DI TUTTI I PRODOTTI DI UN ESERCENTE IN BASE  ALLA MATICOLA DI MACCHINA  
        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');
    
       
        $id_esercente = filter_input(INPUT_GET, 'ide', FILTER_SANITIZE_NUMBER_INT );
      
        $matricola = filter_input(INPUT_GET, 'matr', FILTER_SANITIZE_SPECIAL_CHARS );
  
    
       $prodotti = new Prodotto;
       
      
           $dati_prodotto =  $prodotti->ricerca_prodotti_catalogo_esercente_per_matricola_macchina($id_esercente, $matricola);
      
    
    
    if ($dati_prodotto) {
        
        $content[] = $dati_prodotto;

        // Creo la directory se non esistente
        if ( !file_exists( '../jsontomachine/cataloghiesercenti/'.$matricola )) {
            mkdir( '../jsontomachine/cataloghiesercenti/'.$matricola , 0777, true);
        }

        // scrivo file JSON CATALOGO ESERCENTE DI QUELLA MACCHINA
        if ( file_put_contents( '../jsontomachine/cataloghiesercenti/'.$matricola."/catalogo_".$matricola.".json", json_encode($content))) {
                 // to client
                    echo json_encode($content);
            }
            else { 
                echo "Oops! Error creating json file...";
            }

        
    }

//}


