<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['CLASS_PATH'] . 'class_prodotti.php';
require_once $config['CLASS_PATH'] . 'class_connection.php';
			$prodotto = new Prodotto;
            

$id_tipologia = filter_input(INPUT_POST, 'id_tipologia', FILTER_SANITIZE_NUMBER_INT );

		// INZIALIZZO VARIABILI 
				$allegato = "";   
				$immagine = "";
				$barcode = "";
				$titolo = "";
				$categoria = "";
				$ristretto_per_minori = "";
				$vendibile = "";
				$vendibile_via_web = "";
				$corrispettivi = "";
				$larghezza = "";
				$profondita = "";
				$descrizione = "";
				$prezzo = "";
				$prezzo_scontato = "";

               // UPLOAD EVENTUALE IMMAGINE NUOVA
                        $valid_formats = array("xml", "XML");
                        $max_file_size = 1024*20000; //20 MB
						$path = "../app/uploadxml/"; // Upload directory
						$count = 0;
			
			if( isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['allegato']['name']) ){
				// Loop $_FILES to exeicute all files
				foreach ( $_FILES['allegato']['name'] as $f => $name) {

				 
				    if ($_FILES['allegato']['error'][$f] == 0) {	           
				        if ($_FILES['allegato']['size'][$f] > $max_file_size) {
				            $message[] = "$name file troppo grande!.";
				            echo "<script type=\"text/javascript\">";
	   						echo "alert('FILE TOPPO GRANDE!');";
	   						echo "window.location.href = '?page=carica_catalogo_generale'";
	   						echo "</script>";				            
				           continue; // 
				        }
						elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
							$message[] = "$f FILE NON FORMATO CONSENTITO...";
							echo "<script type=\"text/javascript\">";
	   						echo "alert('FILE NON IN FORMATO CONSENTITO!');";
	   						echo "window.location.href = '?page=carica_catalogo_generale'";
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
  
			// $name;
                        
			$xml=simplexml_load_string(  file_get_contents( 'http://localhost//microhard_git/microhard-cms/app/uploadxml/' . $name )) or die("Error: Cannot create object");
			
			$dati_xml = '';
			foreach( $xml as $obj) {
				$dati_xml .= "BARCODE => ". $obj['code'] ."   PREZZO 1 => ". $obj->prices->price[0] ."   PREZZO 2 => ". $obj->prices->price[1] . "<br>" ;
				$immagine = $obj['id']."_large.png";
				$barcode = $obj['code'];
				$titolo = $obj['name'];
				$categoria = $obj['category'];
				$ristretto_per_minori = $obj['age-restricted'];
					if ( $ristretto_per_minori == 'true') {
						$ristretto_per_minori = 1;
					} else {
						$ristretto_per_minori = 0;
					}
				$vendibile = $obj['sellable'];
					if ( $vendibile == 'true') {
						$vendibile = 1;
					} else {
						$vendibile = 0;
					}
				$vendibile_via_web = $obj['sellable-via-otc']; 
					if ( $vendibile_via_web == 'true') {
						$vendibile_via_web = 1;
					} else {
						$vendibile_via_web = 0;
					}				
				$corrispettivi = $obj['corrispettivi']; 
					if ( $corrispettivi == 'true') {
						$corrispettivi = 1;
					} else {
						$corrispettivi = 0;
					}

				$larghezza = $obj['width'];
				$profondita = $obj['depth'];
				$descrizione = $obj->description;
				$prezzo = $obj->prices->price[0];
				$prezzo_scontato = $obj->prices->price[1]; 

				$insert = $prodotto->inserisci_prodotto_catalogo_generale( $immagine, $barcode, $titolo, $categoria, $ristretto_per_minori,
                                                    $vendibile, $vendibile_via_web, $corrispettivi, $larghezza, $profondita, $descrizione, $prezzo, $prezzo_scontato, $id_tipologia );

			  }

			 /*  if ( $insert == true) {
				$messaggio = "CARICAMENTO CATALOGO EFFETTUATO CORRETTAMENTE ";
			  } else {
				$messaggio = "*** ERRORE CARICAMENTO CATALOGO ***";
			  } */

			  
			
                        
