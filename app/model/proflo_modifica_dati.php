<?php
session_start();
require_once $config['CLASS_PATH'] . 'class_utente.php';

$utente_id = filter_input(INPUT_POST, 'utente_id', FILTER_SANITIZE_NUMBER_INT );
$utente_email = filter_input(INPUT_POST, 'indirizzo_email', FILTER_SANITIZE_EMAIL );
$utente_nome = filter_input(INPUT_POST, 'utente_nome', FILTER_SANITIZE_STRING );
$utente_cognome = filter_input(INPUT_POST, 'utente_cognome', FILTER_SANITIZE_STRING );

 if ( isset($_POST['password']) ) {
    $utente_password =  hash('sha256', filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING ) );
   // $utente_password = hash('sha256', $utente_password);
 } else {
     $utente_password = '';
 } 
    
    
    $utente = new Utente;
                             
    $modifica_dati = $utente->modifica_profilo($utente_id, $utente_nome, $utente_cognome, $utente_email, $utente_password);
    
    if ( $modifica_dati ) {
        $messaggio = "<strong class='text-success'>DATI MODIFICATI CORRETTAMENTE</strong>";
    } else {
        $messaggio = "<strong class='text-danger'>ATTENZIONE ERRORE MODIFICA DATI</strong>";
    }
    
    
