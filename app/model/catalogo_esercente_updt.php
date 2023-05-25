<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['CLASS_PATH'] . 'class_prodotti.php';
require_once $config['CLASS_PATH'] . 'class_macchine.php';
            $carica_iva = new Prodotto;
            $dati_iva = $carica_iva->carica_iva();
            
            $vedi_macchine = new Macchina;
            $elenco_macchine = $vedi_macchine->vedi_macchine($utente);