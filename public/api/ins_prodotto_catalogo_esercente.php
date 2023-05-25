<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//RICERCA DI UN PRODOTTO IN BASE A ID ESERCE ID MACCHINA E ID CANALE 
        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');
    
       
        $dati_macchina_id = filter_input(INPUT_POST, 'macchina_id', FILTER_SANITIZE_SPECIAL_CHARS); // Contiene id macchina e tipologia
        $array_dati_macchina = explode(",", $dati_macchina_id);
        $macchina_id = $array_dati_macchina[0]; 
        $macchina_id_tipologia = $array_dati_macchina[1];
        $codice_a_barre = filter_input(INPUT_POST, 'codice_a_barre', FILTER_SANITIZE_SPECIAL_CHARS);
        $descrizione = filter_input(INPUT_POST, 'descrizione', FILTER_SANITIZE_SPECIAL_CHARS);
        $ristretto_per_minori = filter_input(INPUT_POST, 'ristretto_per_minori', FILTER_SANITIZE_NUMBER_INT);
        $vendibile = filter_input(INPUT_POST, 'vendibile', FILTER_SANITIZE_NUMBER_INT);
        $vendibile_via_web = filter_input(INPUT_POST, 'vendibile_via_web', FILTER_SANITIZE_NUMBER_INT);
        $larghezza = filter_input(INPUT_POST, 'larghezza', FILTER_SANITIZE_NUMBER_INT);
        $profondita = filter_input(INPUT_POST, 'profondita', FILTER_SANITIZE_NUMBER_INT);
        $prezzo = filter_input(INPUT_POST, 'prezzo', FILTER_SANITIZE_NUMBER_INT);
        $prezzo_scontato = filter_input(INPUT_POST, 'prezzo_scontato', FILTER_SANITIZE_NUMBER_INT);
        $iva_id = filter_input(INPUT_POST, 'iva_id', FILTER_SANITIZE_NUMBER_INT);
        $immagine_attuale = filter_input(INPUT_POST, 'immagine_attuale', FILTER_SANITIZE_SPECIAL_CHARS);
        $titolo = filter_input(INPUT_POST, 'titolo', FILTER_SANITIZE_SPECIAL_CHARS);
        $minuti = filter_input(INPUT_POST, 'minuti', FILTER_SANITIZE_NUMBER_INT);
    
       $prodotti = new Prodotto;
       
      
        $dati_prodotto =  $prodotti->inserisci_prodotto_catalogo_esercente_da_macchina( $macchina_id, $codice_a_barre, $descrizione, $ristretto_per_minori,
                                                                                        $vendibile, $vendibile_via_web, $larghezza, $profondita, $prezzo,
                                                                                        $prezzo_scontato, $iva_id, $immagine, $macchina_id_tipologia, $titolo, $minuti,
                                                                                        $canale );
      
    
    
    if ($dati_prodotto) {
        
        $content[] = $dati_prodotto;
        
         echo json_encode($content);
    }




