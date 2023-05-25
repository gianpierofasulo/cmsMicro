<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['CLASS_PATH'] . 'class_utente.php';






            $vedi_profilo = new Utente;
            $dati_profilo = $vedi_profilo->vedi_profilo($_SESSION['utente_id']);
            
            $utente_id = $dati_profilo['id'];
            $utente_nome = $dati_profilo['nome'];
            $utente_cognome = $dati_profilo['cognome'];
            $utente_email = $dati_profilo['email'];
            $utente_ruolo = $dati_profilo['descrizione'];
          