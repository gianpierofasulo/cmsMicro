<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//RICERCA DI UN PRODOTTO DAL CATALOGO GENERALE IN BASE AL BARCODE E TIPO MACCHINA 
        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');
    
       
        $barcode = filter_input(INPUT_GET, 'barcode', FILTER_SANITIZE_SPECIAL_CHARS );
        $id_esercente = filter_input(INPUT_GET, 'ide', FILTER_SANITIZE_NUMBER_INT );
      
      
        $prodotti = new Prodotto;
       
      
           $dati_prodotto =  $prodotti->ricerca_prod_cat_eser_per_barcode($id_esercente, $barcode);
      
    if ($dati_prodotto) {
        
        $content[] = $dati_prodotto;
        
         echo json_encode($content);
    }

//}


