<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');


if ( !isset($_SESSION['utente_ruolo']) || $_SESSION['utente_attivo'] == 0 ) {
    header('Location: index.php');
    exit();
}

require_once $config['CLASS_PATH'] . 'class_utente.php';
require_once $config['CLASS_PATH'] . 'class_macchine.php';
require_once $config['CLASS_PATH'] . 'class_prodotti.php';

            $utenti = new Utente;
            
            // dati accesso dashboard
            $elenco_login = $utenti->statistiche_login();
            
            // Numero utenti
            $numero_utenti = $utenti->conta_utenti();
            
            
            $macchine = new Macchina;
            
            // Num tot macchine
            $numero_totale_macchine = $macchine->numero_totale_macchine();
            
            $prodotti = new Prodotto;
            
            // num tot prodotti cat generale
            $numero_tot_prodotti_cat_generale = $prodotti->numero_prodotti_catalogo_generale();
            
            // num tot prodotti cat esercente
            $numero_tot_prodotti_cat_esercente = $prodotti->numero_prodotti_catalogo_esercente();