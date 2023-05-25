<?php

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{  
        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');
    
        $term = filter_input(INPUT_GET, 'term', FILTER_SANITIZE_SPECIAL_CHARS );
        $id_tipologia_macchina = filter_input(INPUT_GET, 'id_tipologia_macchina', FILTER_SANITIZE_SPECIAL_CHARS );

  
    
       $prodotto = new Prodotto;
       $dati_prodotto = $prodotto->cerca_prodotto_per_barcode($term, $id_tipologia_macchina);
    
    
    if ($dati_prodotto) {
        
        $content[] = $dati_prodotto;
        
         echo json_encode($content);
    }

}


