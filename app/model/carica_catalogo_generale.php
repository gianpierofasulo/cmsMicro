<?php
require_once $config['CONFIG_PATH'] . 'common.php';
// require_once $config['CLASS_PATH'] . 'class_prodotti.php';
require_once $config['CLASS_PATH'] . 'class_macchine.php';

            $carica_tipologie = new Macchina;
            $dati_tipologie = $carica_tipologie->vedi_tipologie();
         