<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//LISTA CANALI ABILITATI I BASE A ID ESERCENTE E ID MACCHINA  
        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');
    
       
        $id_record_da_cancellare = filter_input(INPUT_POST, 'id_record', FILTER_SANITIZE_NUMBER_INT );
       
    
            $prodotti = new Prodotto;
       
            $dati_prodotto =  $prodotti->cancella_prod_vetrina_digitale($id_record_da_cancellare);
      
    
    
    if ($dati_prodotto) {
        
         echo json_encode($dati_prodotto);
    }




