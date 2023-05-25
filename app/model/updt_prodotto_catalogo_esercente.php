<?php
session_start();
/* header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); */

//AGGIORNAMENTO  DI UN PRODOTTO CATALOGO ESERCENTE DATI PROVENIENTI DALLA MACCHINA, IN BASE A ID ESERCE ID MACCHINA E ID CANALE 
        // Controllo dati utente
        // require_once('../app/class/class_prodotti.php');
        require_once $config['CLASS_PATH'] . 'class_prodotti.php';
        $utente_id = filter_input(INPUT_POST, 'id_utente', FILTER_SANITIZE_NUMBER_INT);
        $id_prodotto = filter_input(INPUT_POST, 'id_prodotto', FILTER_SANITIZE_NUMBER_INT);
        $macchina_id = filter_input(INPUT_POST, 'id_macchina', FILTER_SANITIZE_NUMBER_INT);
        $canale = filter_input(INPUT_POST, 'canale', FILTER_SANITIZE_NUMBER_INT);

        $descrizione = filter_input(INPUT_POST, 'descrizione', FILTER_SANITIZE_SPECIAL_CHARS);       
        $vendibile = filter_input(INPUT_POST, 'vendibile', FILTER_SANITIZE_NUMBER_INT);
        $vendibile_via_web = filter_input(INPUT_POST, 'vendibile_via_web', FILTER_SANITIZE_NUMBER_INT);
        $larghezza = filter_input(INPUT_POST, 'larghezza', FILTER_SANITIZE_NUMBER_INT);
        $profondita = filter_input(INPUT_POST, 'profondita', FILTER_SANITIZE_NUMBER_INT);
        $prezzo = filter_input(INPUT_POST, 'prezzo', FILTER_SANITIZE_NUMBER_INT);
        $titolo = filter_input(INPUT_POST, 'titolo', FILTER_SANITIZE_SPECIAL_CHARS);
      
        $prodotti = new Prodotto;
        
        $dati_prodotto =  $prodotti->aggiorna_prodotto_catalogo_esercente_da_macchina(  $utente_id, $id_prodotto,  $macchina_id, $canale, 
                                                                                        $descrizione, $vendibile,
                                                                                        $vendibile_via_web, $larghezza, $profondita, $prezzo,
                                                                                        $titolo
                                                                                         );
      
    
    
    if ($dati_prodotto == true) {
        
     //   $content[] = $dati_prodotto;
        $content['response'] = 'ok';
        
    } else {
        $content['response'] = 'err';
    }

    $dati_valori = "{
        utente_id: $utente_id
        id_prodotto: $id_prodotto
        macchina_id: $macchina_id
        canale: $canale 
        descrizione: $descrizione
        vendibile: $vendibile
        vendibile_via_web: $vendibile_via_web
        larghezza: $larghezza
        profondita: $profondita
        prezzo: $prezzo
        titolo: $titolo
    }";

    echo json_encode( $dati_valori);

 //   echo json_encode($dati_prodotto);




