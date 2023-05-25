<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//AGGIORNAMENTO  DI UN PRODOTTO CATALOGO ESERCENTE DATI PROVENIENTI DALLA MACCHINA, IN BASE A ID ESERCE ID MACCHINA E ID CANALE 
        // Controllo dati utente
        require_once('../../app/class/class_prodotti.php');

   
        $utente_id = $_POST['id_utente'];
        $id_prodotto = $_POST['id_prodotto'];
        $macchina_id = $_POST['id_macchina'];
        // VECCHIA CHIAMATA ORA L'ALIAS VIENE PASSATO DAL CLIENT COME SE FOSSE IL CANALE - $canale = $_POST['canale'];
        $canale = $_POST['alias']; // SAREBBE ALIAS

        $descrizione = $_POST['descrizione'];       
        $vendibile = $_POST['vendibile'];
        $vendibile_via_web = $_POST['vendibile_via_web'];
        $larghezza = $_POST['larghezza'];
        $profondita = $_POST['profondita'];
        $prezzo = $_POST['prezzo'];
        $titolo = $_POST['titolo'];


      
        $prodotti = new Prodotto;
       
      
        $dati_prodotto =  $prodotti->aggiorna_prodotto_catalogo_esercente_da_macchina(  $utente_id, $id_prodotto,  $macchina_id, $canale, 
                                                                                        $descrizione, $vendibile,
                                                                                        $vendibile_via_web, $larghezza, $profondita, $prezzo,
                                                                                        $titolo
                                                                                         );
      
     
  /*   if ($dati_prodotto[0] == 1) {
        
     //   $content[] = $dati_prodotto;
        $content['response'] = 'ok';
        
    } else {
        $content['response'] = 'err';
    } */


   echo json_encode( $dati_prodotto);

  




