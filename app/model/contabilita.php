<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['CLASS_PATH'] . 'class_macchine.php';
            
            $vedi_macchine = new Macchina;

            if ( $_SESSION['utente_id_ruolo'] > 2 ) {
                $elenco_macchine = $vedi_macchine->vedi_macchine($utente);
            } else {
                $elenco_macchine = $vedi_macchine->vedi_macchine_admin();
            }
            