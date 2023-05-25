<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['CLASS_PATH'] . 'class_prodotti.php';
//require_once $config['CLASS_PATH'] . 'class_macchine.php';
$esercente_id = $_SESSION['utente_id'];
    
  $dati_macchina = filter_input(INPUT_POST, 'macchina_matricola', FILTER_SANITIZE_SPECIAL_CHARS); 
  $pieces = explode(",", $dati_macchina);
  $id_macchina = $pieces[0];
  $matricola_macchina = $pieces[1];
  

  $id_prodotto = filter_input(INPUT_POST, 'id_prodotto', FILTER_SANITIZE_NUMBER_INT);
  // Flag prodotto multicanale
  $multi_canale = filter_input(INPUT_POST, 'multi_canale', FILTER_SANITIZE_NUMBER_INT);
  
  // Canale sul quale mettere il prodotto
  $alias_canale = filter_input(INPUT_POST, 'alias_canale', FILTER_SANITIZE_SPECIAL_CHARS); 
  
  // LARGHEZZA sarebbe il Numero di canali da occupare (prodotto multicanale)
  $larghezza = filter_input(INPUT_POST, 'numero_di_canali', FILTER_SANITIZE_NUMBER_INT);

  
 
    $prodotto = new Prodotto;
  
    if ($multi_canale == 0) { 
      // Prodotto su un solo canale 
      $dati_prodotto = $prodotto->associa_prodotto_canale_da_macchina($matricola_macchina, $id_prodotto, $alias_canale); 
    } else { 
    
      // Prodotto multicanale
      $dati_prodotto = $prodotto->associa_prodotto_multicanale_da_macchina($matricola_macchina, $id_prodotto, $alias_canale, $larghezza); 
    }

      // MEssaggio di ritorno dalla Query
      if ( $dati_prodotto ) {
        // CREO JSON PER LA MACCHINA
        $datiJson =  $prodotto->crea_json_canali_da_macchina($matricola_macchina, $esercente_id);

        if ( !file_exists( '../public/jsontomachine/canali/'.$esercente_id.'/'. $matricola_macchina.'/' ) ) {
                                
          mkdir( '../public/jsontomachine/canali/'.$esercente_id.'/'. $matricola_macchina.'/' , 0777, true);
        } 

      if ( file_put_contents( '../public/jsontomachine/canali/'.$esercente_id.'/'. $matricola_macchina.'/'.'/canali_A.json', json_encode($datiJson))) {
       
        $messaggio = "<h3>INSERIMENTO AVVENUTO CORRETTAMENTE </h3>".print_r($dati_prodotto);

      } else {
        $messaggio = print_r($dati_prodotto);
      }
    }
