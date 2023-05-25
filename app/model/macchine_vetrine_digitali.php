<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['CLASS_PATH'] . 'class_prodotti.php';
require_once $config['CLASS_PATH'] . 'class_macchine.php';


if (filter_input(INPUT_GET, 'idm', FILTER_SANITIZE_SPECIAL_CHARS )) {
        $id_macchina_get = filter_input(INPUT_GET, 'idm', FILTER_SANITIZE_SPECIAL_CHARS );
} else {
    $id_macchina_get = 0;
}
if (filter_input(INPUT_GET, 'idv', FILTER_SANITIZE_SPECIAL_CHARS )) {
    $id_vetrina_get =  str_replace(' ', '%20', filter_input(INPUT_GET, 'idv', FILTER_SANITIZE_SPECIAL_CHARS ));
   
} else {
    $id_vetrina_get = 0;    
}


            $carica_iva = new Prodotto;
            $dati_iva = $carica_iva->carica_iva();

            $carica_catalogo_esercente = new Prodotto;
            $catalogo_prodotti = $carica_catalogo_esercente->elenco_catalogo_per_esercente($utente);

           
            
            
            $vedi_macchine = new Macchina;
            $elenco_macchine = $vedi_macchine->vedi_macchine_vetrine_digitali($utente);

            if ($elenco_macchine) {
                foreach( $elenco_macchine as $row_macchina) {
                    // mi serve dopo per prendere le categorie prodotti in base alla tipologia
                    $tipologia = $row_macchina["descrizione"];
                   
                }
                $elenco_categorie_vetrina = $carica_catalogo_esercente->elenco_categorie_vetrina($tipologia);
                
            } else {
                die('errore categorie');
            }
            
         