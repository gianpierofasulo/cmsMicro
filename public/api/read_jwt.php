<?php

  // Carico autoload per JWT
  require_once('../vendor/autoload.php');
  // namspace \Firebase\JWT\ e classe JWT
  use \Firebase\JWT\JWT;

  use Firebase\JWT\Key;

    

function controlla_jwt($data) {    
    // legge dati in POST e solo in POST nel body
    // se il token viene passato come oggetto JSON
   // $data = json_decode(file_get_contents("php://input") );

    // se il token viene passato negli header nella chiave Authorization
    // leggo tutti gli header
    //       $all_headers = getallheaders();

    //       $data->JWT = $data;

        try{
            $secret_key = "owt125";
           
            // Decodifico i dati in base alla secret 
            $dati_decodificati = JWT::decode($data, new Key($secret_key, 'HS256' ) );

            // http_response_code(200);
        
            $datiRitorno =  array(
                "status" => 1,
                "message" => 'Autenticato JWT',
                "user_data" => $dati_decodificati
            );

            return $datiRitorno;

        } catch (Exception $ex) {
            // http_response_code(500);
        
            $datiRitorno =  array(
                "status" => 0,
                "message" => $ex->getMessage()
            );

            return $datiRitorno;

        }



}