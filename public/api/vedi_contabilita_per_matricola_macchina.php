<?php

//if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
// {  
        // Controllo dati utente
        require_once('../../app/class/class_contabilita.php');
    
        $id_esercente = filter_input(INPUT_POST, 'ide', FILTER_SANITIZE_NUMBER_INT );
        $id_macchina = filter_input(INPUT_POST, 'idm', FILTER_SANITIZE_NUMBER_INT );
      
       $contabilita = new Contabilita;

       $dati_contabilita = $contabilita->carica_contabilita($id_esercente, $id_macchina);
       $dati_contabilita_motori = $contabilita->carica_contabilita_motori($id_esercente, $id_macchina);
    
    
    if ($dati_contabilita) {
        
        $content[] = $dati_contabilita;
        
    }

    if ($dati_contabilita_motori) {
        
       //$content[] += $dati_contabilita_motori;
        array_push($content, $dati_contabilita_motori);
        
    }

    header('Content-Type: application/json');
    echo json_encode($content);

// }


