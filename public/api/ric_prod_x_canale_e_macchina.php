<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//RICERCA DI UN PRODOTTO IN BASE A ID ESERCE ID MACCHINA E ID CANALE 
        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');
    
       
        $id_esercente = filter_input(INPUT_GET, 'ide', FILTER_SANITIZE_NUMBER_INT );
        $id_canale = filter_input(INPUT_GET, 'idc', FILTER_SANITIZE_NUMBER_INT );
       
        $matricola = filter_input(INPUT_GET, 'matr', FILTER_SANITIZE_SPECIAL_CHARS );
  
    
       $prodotti = new Prodotto;
       
      
           $dati_prodotto =  $prodotti->ricerca_prodotto_catalogo_esercente_per_canale_e_matricola_macchina($id_esercente, $id_canale, $matricola);
      
    
    
    if ($dati_prodotto) {
        
        $content[] = $dati_prodotto;

        // testare se vuoto e dare response 'CANALE VUOTO'
        
         echo json_encode($content);
    }




