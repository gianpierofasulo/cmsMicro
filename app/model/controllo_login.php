<?php

/* 
 * Verifica login
 */


require_once $config['CLASS_PATH'] . 'class_login.php';
require_once $config['CLASS_PATH'] . 'class_connection.php';
require_once $config['CLASS_PATH'] . 'class_utente.php';

require_once $config['VENDOR_PATH'] . 'autoload.php';


$email = filter_input(INPUT_POST, 'indirizzo_email', FILTER_SANITIZE_EMAIL );
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING );
$client_ip = filter_input(INPUT_POST, 'ip_client', FILTER_SANITIZE_STRING );

$otp = filter_input(INPUT_POST, 'codice_otp', FILTER_SANITIZE_NUMBER_INT );

 if ($email && $password && $otp) {
            $authenticator = new PHPGangsta_GoogleAuthenticator();
   
            $login = new Login;
            $controllo_login = $login->controllo($email, $password);
            
            
            $utente_id = $controllo_login['id'];
            $utente_nome = $controllo_login['nome'];
            $utente_cognome = $controllo_login['cognome'];
            $utente_email = $controllo_login['email'];
            $utente_password = $controllo_login['password'];
            $utente_data_scadenza = $controllo_login['data_scadenza'];
            $utente_attivo = $controllo_login['attivo'];
            $utente_id_ruolo = $controllo_login['ruolo_id'];
            $utente_ruolo = $controllo_login['descrizione'];
            
          
            // $vedi_secret = Login::controlla_secret($client_ip, $utente_id);
            $vedi_secret = $login->controlla_secret($client_ip, $utente_id);
            $secret = $vedi_secret['secret'];
            $id_record = $vedi_secret['id'];
         

            $tolerance = 1;
                //Every otp is valid for 30 sec.
                // If somebody provides OTP at 29th sec, by the time it reaches the server OTP is expired.
                //So we can give tolerance =1, it will check current  & previous OTP.
                // tolerance =2, verifies current and last two OTPS

            $checkResult = $authenticator->verifyCode($secret, $otp, $tolerance);    

            if ($checkResult) 
            {
                 // $valida_secret = Login::valida_secret($id_record);
                 $valida_secret = $login->valida_secret($id_record);
                
                if ($valida_secret) {
                    // REDIRECT TO CMS APP
                    // Registro dati in sessione
                    $utente = new Utente;
                    $registra_sessione = $utente->registra_sessione( $utente_id, $utente_nome, $utente_cognome, $utente_email,
                            $utente_data_scadenza, $utente_attivo, $utente_ruolo, $utente_id_ruolo);
                    if (!$registra_sessione) {
                        die('ERRORE GESTIONE SESSIONE');
                    }
                    header('Location: index.php?page=layout');
                    exit();
                } else {
                    die('ERRORE AGGIORNAMENTO SECRET');
                    
                }
                

            } else {
                echo 'AUTENTICAZIONE FALLITA';
                exit;
            }

 } else {
     die('NON AUTORIZZATO.');
 }
