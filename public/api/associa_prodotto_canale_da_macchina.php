<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//LISTA CANALI ABILITATI I BASE A ID ESERCENTE E ID MACCHINA  
        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');
    
       
        $id_prodotto_da_associare = filter_input(INPUT_GET, 'idp', FILTER_SANITIZE_NUMBER_INT );
        $canale = filter_input(INPUT_GET, 'can', FILTER_SANITIZE_NUMBER_INT );
        $matricola_macchina = filter_input(INPUT_GET, 'matr', FILTER_SANITIZE_SPECIAL_CHARS );
  
    
       $prodotti = new Prodotto;
       
      
           $dati_prodotto =  $prodotti->associa_prodotto_canale_da_macchina( $matricola_macchina, $id_prodotto_da_associare, $canale );
      
    
    
    if ($dati_prodotto) {
        
        $content[] = $dati_prodotto;
        
         echo json_encode($content);
    }




