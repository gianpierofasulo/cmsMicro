<?php
session_start();
$messaggio = '';

        //RICERCA  PRODOTTI DI UN ESERCENTE IN BASE  ALLA MATICOLA DI MACCHINA  E ID ESERCENTE
        
        require_once('../app/class/class_prodotti.php');
    
       $id_macchina = filter_input(INPUT_POST, 'id_macchina_json', FILTER_SANITIZE_NUMBER_INT ); 
      
       $prodotti = new Prodotto;
       
      
       $dati_catalgo =  $prodotti->elenco_catalogo_per_macchina($id_macchina);
      
    
    
    if ($dati_catalgo) {
        
       // $content[] = $dati_catalgo;

        // Creo la directory se non esistente
         if ( !file_exists( '../public/jsontomachine/cataloghiesercenti/'.$_SESSION['utente_id'].'/' ) ) {
                     
            mkdir( '../public/jsontomachine/cataloghiesercenti/'.$_SESSION['utente_id'] , 0777, true);
        } 
      

        // scrivo file JSON CATALOGO ESERCENTE DI QUELLA MACCHINA
        if ( file_put_contents( '../public/jsontomachine/cataloghiesercenti/'.$_SESSION['utente_id'].'/catalogoesercente.json', json_encode($dati_catalgo))) {
                 
                    $messaggio = "FILE JSON CREATO CORRETTAMENTE";
            }
            else { 
                $messaggio = "Oops! Error creazione json file...";
            }

        
    }




