<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');
       
       
        $id_record = filter_input(INPUT_POST, 'id_record', FILTER_SANITIZE_NUMBER_INT );
        $id_prodotto_selezionato = filter_input(INPUT_POST, 'id_prodotto_selezionato', FILTER_SANITIZE_NUMBER_INT );
        
    
            $prodotti = new Prodotto;
       
            $dati_prodotto =  $prodotti->modifica_prod_vetrina_digitale($id_record, $id_prodotto_selezionato);
      
    
    
    if ($dati_prodotto) {
        
         echo json_encode($dati_prodotto);
    }




