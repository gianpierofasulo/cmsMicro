<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');
       
        $id_slot = filter_input(INPUT_POST, 'id_slot', FILTER_SANITIZE_NUMBER_INT );
        $id_prodotto_selezionato = filter_input(INPUT_POST, 'id_prodotto_selezionato', FILTER_SANITIZE_NUMBER_INT );
        $id_esercente = filter_input(INPUT_POST, 'id_esercente', FILTER_SANITIZE_NUMBER_INT );
        $id_macchina = filter_input(INPUT_POST, 'id_macchina', FILTER_SANITIZE_NUMBER_INT );
        $layout = filter_input(INPUT_POST, 'layout', FILTER_SANITIZE_SPECIAL_CHARS );
        $id_vetrina = filter_input(INPUT_POST, 'id_vetrina', FILTER_SANITIZE_SPECIAL_CHARS );

        
    
            $prodotti = new Prodotto;
       
            $dati_prodotto =  $prodotti->aggiungi_prod_vetrina_digitale( $id_slot, $id_prodotto_selezionato, $id_esercente, $id_macchina, $layout, $id_vetrina );
      
    
    
    if ($dati_prodotto) {
        
         echo json_encode($dati_prodotto);
    }




