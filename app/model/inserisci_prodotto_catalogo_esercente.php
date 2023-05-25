<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['CLASS_PATH'] . 'class_prodotti.php';
//require_once $config['CLASS_PATH'] . 'class_macchine.php';
           
  $dati_macchina_id = filter_input(INPUT_POST, 'macchina_id', FILTER_SANITIZE_SPECIAL_CHARS); // Contiene id macchina e tipologia
  $array_dati_macchina = explode(",", $dati_macchina_id);
  $macchina_id = $array_dati_macchina[0]; 
  $macchina_id_tipologia = $array_dati_macchina[1];
  $codice_a_barre = filter_input(INPUT_POST, 'codice_a_barre', FILTER_SANITIZE_SPECIAL_CHARS);
  $descrizione = filter_input(INPUT_POST, 'descrizione', FILTER_SANITIZE_SPECIAL_CHARS);
  $ristretto_per_minori = filter_input(INPUT_POST, 'ristretto_per_minori', FILTER_SANITIZE_NUMBER_INT);
  $vendibile = filter_input(INPUT_POST, 'vendibile', FILTER_SANITIZE_NUMBER_INT);
  $vendibile_via_web = filter_input(INPUT_POST, 'vendibile_via_web', FILTER_SANITIZE_NUMBER_INT);
  $larghezza = filter_input(INPUT_POST, 'larghezza', FILTER_SANITIZE_NUMBER_INT);
  $profondita = filter_input(INPUT_POST, 'profondita', FILTER_SANITIZE_NUMBER_INT);
  $prezzo = filter_input(INPUT_POST, 'prezzo', FILTER_SANITIZE_NUMBER_INT);
  $prezzo_scontato = filter_input(INPUT_POST, 'prezzo_scontato', FILTER_SANITIZE_NUMBER_INT);
  $iva_id = filter_input(INPUT_POST, 'iva_id', FILTER_SANITIZE_NUMBER_INT);
  $immagine_attuale = filter_input(INPUT_POST, 'immagine_attuale', FILTER_SANITIZE_SPECIAL_CHARS);
  $titolo = filter_input(INPUT_POST, 'titolo', FILTER_SANITIZE_SPECIAL_CHARS);
  $minuti = filter_input(INPUT_POST, 'minuti', FILTER_SANITIZE_NUMBER_INT);
  
  
  
$allegato = "";        
            
               // UPLOAD EVENTUALE IMMAGINE NUOVA
                        $valid_formats = array("jpg", "png", "gif", "JPG", "PNG");
                        $max_file_size = 1024*10000; //10 MB
			$path = "../app/immaginiprodotti/"; // Upload directory
			$count = 0;
			
			if( isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['allegato']['name']) ){
				// Loop $_FILES to exeicute all files
				foreach ( $_FILES['allegato']['name'] as $f => $name) {

				 
				    if ($_FILES['allegato']['error'][$f] == 0) {	           
				        if ($_FILES['allegato']['size'][$f] > $max_file_size) {
				            $message[] = "$name file troppo grande!.";
				            echo "<script type=\"text/javascript\">";
	   						echo "alert('FILE TOPPO GRANDE!');";
	   						echo "window.location.href = '?page=catalogo_esercente'";
	   						echo "</script>";				            
				           continue; // 
				        }
						elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
							$message[] = "$f FILE NON FORMATO CONSENTITO...";
							echo "<script type=\"text/javascript\">";
	   						echo "alert('FILE NON IN FORMATO CONSENTITO!');";
	   						echo "window.location.href = '?page=catalogo_esercente'";
	   						echo "</script>";
							continue; // 
						}
				        else{ // Tutto ok, sposta il file uploadatao  
				        	$name = str_replace("'","",$name);
				        	$allegato = str_replace(" ","",$name);
				        	
				            # $name = preg_replace("/[^a-zA-Z]+/", "", $name);
				            if(move_uploaded_file($_FILES["allegato"]["tmp_name"][$f], $path.$name))
				            // nomealizzo nome file
							
				            // nome del file caricato
				           	$nome_file[$count] = $name;	
				        	# $nome_file[$count] = preg_replace("/[^a-zA-Z]+/", "", $nome_file[$count]);
				            $count++; // File caricato correttamente
				        }
				    }
				    
				}
			} // END UPLOAD  ******************************************************************************
  
                        $prodotto = new Prodotto;
                        
 if ( $name ) {
     // ha cambiato immagine
       
       $dati_prodotto = $prodotto->inserisci_prodotto_catalogo_esercente( $macchina_id, $codice_a_barre, $descrizione, $ristretto_per_minori,
                                                       $vendibile, $vendibile_via_web, $larghezza, $profondita, $prezzo,
                                                       $prezzo_scontato, $iva_id, $name, $macchina_id_tipologia, $titolo, $minuti );
 } else {
       $dati_prodotto = $prodotto->inserisci_prodotto_catalogo_esercente( $macchina_id, $codice_a_barre, $descrizione, $ristretto_per_minori,
                                                       $vendibile, $vendibile_via_web, $larghezza, $profondita, $prezzo,
                                                       $prezzo_scontato, $iva_id, $immagine_attuale, $macchina_id_tipologia, $titolo, $minuti  );
}


      // MEssaggio di ritorno dalla Query
      $messaggio = $dati_prodotto;

   
                        
