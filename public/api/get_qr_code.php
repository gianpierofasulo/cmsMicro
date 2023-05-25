<?php


if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{  
        // Controllo dati utente
        require_once('../../app/class/class_login.php');

        $email = filter_input(INPUT_POST, 'indirizzo_email', FILTER_SANITIZE_EMAIL );
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING );
        $client_ip = filter_input(INPUT_POST, 'client_ip', FILTER_SANITIZE_STRING );


        if ($email && $password && $client_ip) {
                        
           // $controllo_login = Login::controllo($email, $password);
            
           $login = new Login;
           $controllo_login =  $login->controllo($email, $password);

            if ($controllo_login) {
                // TUTTO OK GENERA SECRET E REGISTA DATI IN TAB utente_login
                 $utente_id = $controllo_login['id'];
                 
                // Genero SECRET
                //require '../vendor/autoload.php';
                 require_once('../../app/vendor/autoload.php');
                $authenticator = new PHPGangsta_GoogleAuthenticator();
                $secret = $authenticator->createSecret();
                
               //  $registra_secret = Login::registra_secret( $client_ip, $utente_id, $secret);
                 $registra_secret = $login->registra_secret( $client_ip, $utente_id, $secret);
                 
                
                if ($registra_secret) {

                    // $website = 'https://www.gfasulo.it'; //Your Website
                    $website = 'http://localhost'; //Your Website 
                    $title= 'Gianpiero Fasulo';
                    $qrCodeUrl = $authenticator->getQRCodeGoogleUrl($title, $secret,$website);
                    # echo $qrCodeUrl;
                    #echo "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl= $qrCodeUrl&choe=UTF-8";

                    $dati = array();

                    $dati['qrCodeUrl'] = $qrCodeUrl;

                     echo json_encode($dati);
                } else {
                     echo json_encode($registra_secret);
                }
                
                
            } 
             else {
                     echo json_encode($controllo_login);
                } // END CONTOLLO LOGIN
        } 
        
        
} // END CONTOLLO CHIAMATA AJAX