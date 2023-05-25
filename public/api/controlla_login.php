<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// CONTROLLO CHE SIA UNA CHIAMATA AJAX *******************************************
// if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
// { 


require_once('../../app/class/class_login.php'); 
// Carico autoload per JWT
require_once('../vendor/autoload.php');
// namspace \Firebase\JWT\ e classe JWT
use \Firebase\JWT\JWT;


$email = filter_input(INPUT_POST, 'indirizzo_email', FILTER_SANITIZE_EMAIL );
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS );


 if ($email && $password) {
    
    $login = new Login;
    $controllo_login = $login->controllo($email, $password);
    
    
    if ( $controllo_login) {
        
        $content[] = $controllo_login;

        //JWT Payload
        $iss = "localhost";
        $iat = time();
        $nbf = $iat + 10;
        $exp = $iat + 60; // expiration time + 60 sec
        $aud = "myusers";

      /*   $user_id = $content['id'];
        $user_nome = $content['nome'];
        $user_email = $content['email']; */

        $user_arr_data = array (
            "id" => $content[0]['id'],
            "name" => $content[0]['cognome'].' '.$content[0]['nome'],
            "email" => $content[0]['email']
        );
        // iss - chi ha creato il token
        // iat - rilasciato in Unix Time Epoc
        // nbf - not valid before - non valido prima di (es 10 secondi aggiunti all' iaf)
        // exp - expiration time
        // aud - audience - per cosa viene utilizzato questo tokent
        $payload_info = array(
            "iss"=> $iss,
            "iat"=> $iat,
            "nbf"=> $nbf,
           
            "aud"=> $aud,
            "data"=> $user_arr_data
        );

        $secret_key = "owt125";

        $JWT = JWT::encode($payload_info, $secret_key, 'HS256' );

        $content[0]['JWT'] = $JWT;

         echo json_encode($content);
    } else {
		 $content = [ 'risposta' => 'KO'];
        echo json_encode($content);
    }
 } // END IF EMAIL E PASSWORD

// } // END CHIAMATA AJAX

