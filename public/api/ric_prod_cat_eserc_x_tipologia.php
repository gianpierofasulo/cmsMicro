<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//RICERCA DI TUTTI I PRODOTTI DI UN ESERCENTE IN BASE ANCHE ALLA TIPOLGIA DI MACCHINA  
        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');
    
       
        $id_esercente = filter_input(INPUT_GET, 'ide', FILTER_SANITIZE_NUMBER_INT );
      
        $id_tipolgia_macchina = filter_input(INPUT_GET, 'idtip', FILTER_SANITIZE_NUMBER_INT );
  
    
       $prodotti = new Prodotto;
       
      
           $dati_prodotto =  $prodotti->ricerca_prodotti_catalogo_esercente_per_tipologia_macchina($id_esercente, $id_tipolgia_macchina);
      
    
    
    if ($dati_prodotto) {
        
        $content[] = $dati_prodotto;
        
         echo json_encode($content);
    }

//}


