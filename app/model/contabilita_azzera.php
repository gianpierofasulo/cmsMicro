<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['CLASS_PATH'] . 'class_contabilita.php';
           
            $id_esercente = filter_input(INPUT_POST, 'id_esercente', FILTER_SANITIZE_NUMBER_INT );
            $id_macchina = filter_input(INPUT_POST, 'id_macchina', FILTER_SANITIZE_NUMBER_INT );
			$matricola_macchina_form = filter_input(INPUT_POST, 'matricola_macchina_form', FILTER_SANITIZE_SPECIAL_CHARS );
			$body_contabilita_motori = '';
          
            $contabilita = new Contabilita;
    
           if ($id_esercente && $id_macchina) {

            	$azzera_contabilita = $contabilita->azzera_contabilita($id_esercente, $id_macchina);

				if ( $azzera_contabilita == true) {

						if ( !file_exists( '../public/jsontomachine/contabilita/'.$id_esercente.'/'. $matricola_macchina_form.'/' ) ) {
										
							mkdir( '../public/jsontomachine/contabilita/'.$id_esercente.'/'. $matricola_macchina_form.'/' , 0777, true);
						} 

						if ( !file_put_contents( '../public/jsontomachine/contabilita/'.$id_esercente.'/'. $matricola_macchina_form.'/'.'/contabilita.json', json_encode(''))) {
					
								return $messaggio = "ERRORE AZZERAMENTO CONTABILITA' - ";
						} else {

								$azzera_contabilita_motori = $contabilita->azzera_contabilita_motori($id_esercente, $id_macchina);

								if ( $azzera_contabilita_motori == true) {

									if ( !file_exists( '../public/jsontomachine/contabilita_motori/'.$id_esercente.'/'. $matricola_macchina_form.'/' ) ) {
													
										mkdir( '../public/jsontomachine/contabilita_motori/'.$id_esercente.'/'. $matricola_macchina_form.'/' , 0777, true);
									} 
				
									if ( !file_put_contents( '../public/jsontomachine/contabilita_motori/'.$id_esercente.'/'. $matricola_macchina_form.'/'.'/contabilita_motori.json', json_encode([]) ) ) {
									
										return $messaggio = "ERRORE AZZERAMENTO CONTABILITA' MOTORI -";
									} else {
										return $messaggio = "AZZERAMENTO CONTABILITA' EFFETTUATO CORRETTAMENTE - ";
									}

								}
							}
           
        		}
			} 