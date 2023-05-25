<?php

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{  
        // Controllo dati utente
        require_once('../../app/class/class_utente.php');
    
      
       $esercenti = new Utente;
       $dati_esercenti = $esercenti->conta_utenti();
    
    
    if ($dati_esercenti) {
        
        $content[] = $dati_esercenti;
         header('Content-Type: application/json');
         echo json_encode($content);
    }

}


