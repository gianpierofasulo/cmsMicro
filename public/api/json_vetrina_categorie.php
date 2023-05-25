<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        require_once('../../app/class/class_json_from_machine.php');

        $json = file_get_contents('php://input');
        $jsonData = json_decode($json, true);

        $id_utente = $jsonData[0]['id_utente'];
        $id_macchina = $jsonData[0]['id_macchina'];;
        $JsonDATA = $jsonData[0]['jsondata']; // DATI FILE JSON
   
      /*   $id_utente = filter_input(INPUT_POST, 'id_utente', FILTER_SANITIZE_NUMBER_INT );
        $id_macchina = filter_input(INPUT_POST, 'id_macchina', FILTER_SANITIZE_NUMBER_INT );
        $JsonDATA = $_POST['jsondata']; // DATI FILE JSON */
        // END POINT è un dato fisso serve per scriverlo nella tab dei log operazioni
        $endpoint_richiamato = "json_vetrina_categorie.php";
         
        $decoded_json = json_decode($JsonDATA, false);

       
        $JsonFromMachine = new JsonFromMachine;
       
      
        $dati_log = $JsonFromMachine->scrivi_log_operazioni($id_utente, $id_macchina, $endpoint_richiamato, $JsonDATA);
        
        if ( $dati_log == 'OK') {
               $update_table = $JsonFromMachine->carica_json_vetrina_digitale_categorie('vetrina_categorie',$JsonDATA, $id_utente, $id_macchina);
          
               echo json_encode( $update_table ); 
          } else {
               echo json_encode( $dati_log );  
          }
  




