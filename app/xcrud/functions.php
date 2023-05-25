<?php

function dividi_importo_credito($value, $fieldname, $primary_key, $row, $xcrud) {
    return '€ ' . $value / 100;
}

function vedi_date_ticket($value, $fieldname, $primary_key, $row, $xcrud) {
   // $dataticket = new DateTime( $row['tickets.dataticket']);
    $validity = new DateTime( $row['tickets.validity'] );
    $data_odierna = new DateTime( date('Y-m-d H:i:s') );
    
    if ( !($validity >= $data_odierna)  ) {
        $interval ="SCADUTO ";
    } else {
        $interval ="NON SCADUTO";
    }


    return $value.' '.$interval ;
}




function cancella_files( $primary) {

    // devo fare query perchè before_remove passa solo la chiave record
    $db = Xcrud_db::get_instance();
	
    $query_vedi_files = "select immagine from media where id = $primary ";
          

    $db->query( $query_vedi_files );
    $result_vedi_files = $db->result();
    foreach ($result_vedi_files as $key => $item)
                    {
                        $immagine = $item['immagine'];
                      
                    }
                    
   

  /*   if( file_exists( '../../public/media/'.$_SESSION['utente_id'].'/'.$video ))
    {
         unlink('../../public/media/'. $_SESSION['utente_id'] .'/'.$video);
        
    } */

    if( file_exists( '../../public/media/'. $_SESSION['utente_id'] .'/'.$immagine ))
    {
         unlink('../../public/media/'.  $_SESSION['utente_id'] .'/'.$immagine);
         // Cancello anche lìanteprima
        //unlink('../../public/media/'.  $_SESSION['utente_id'] .'/'.$immagine.'_anteprima');
        
    }
    
}

function inserisci_canali_vuoti($postdata, $primary) {

       $numero_canali = $postdata->get('numero_canali');
       $numero_righe = $postdata->get('numero_righe');
       $macchina_esercente_id = $primary;
       $numero_prodotti_per_riga = $numero_canali / $numero_righe;
       $conta_righe = 0;
       $riga_iniziale = 0;
       $id_esercente = $postdata->get('utente_id');
       $db = Xcrud_db::get_instance();

       // CICLO PER IL NUMERO DI CANALI DELLA MACCHINA E INSERISCO TANTE RIGHE QUANTI SONO I CANALI
       // NELLA TAB macchina_esercente_canali mettendoli con alias = 0 e abilitato = 0
       for ( $c = 0; $c <= $numero_canali-1; $c++) {

                // calcolo il numero di riga del prodotto
                if ( $conta_righe < $numero_prodotti_per_riga ) {
                    $riga_iniziale = $riga_iniziale;
                } 
                
                $query_inserisci_canali = "INSERT INTO macchina_esercente_canali (macchina_esercente_id, canale, alias, stato, riga, id_esercente) 
                VALUES ($macchina_esercente_id, $c, 0, 'Disabilitato', $riga_iniziale, $id_esercente);";
                $conta_righe++;

                if ( $conta_righe == $numero_prodotti_per_riga ) {
                    $conta_righe = 0;
                    $riga_iniziale++;
                } 

           
                $db->query( $query_inserisci_canali );
               // $result_vedi_canali = $db->result();
      }
}

function aggiorna_alias_vetrina($postdata, $xcrud){
    $alias = $postdata->get('alias');
    $macchina_esercente_id = $postdata->get('macchina_esercente_id');

    // aggiorno i dati del canale/alias nella tab vetrina perchè potrebbe aver modificato l'alias nella tab canali
    $db = Xcrud_db::get_instance();

    $query_aggiorna_alias = "UPDATE vetrina_macchina set  where id = $macchina_esercente_id ";
              
	
        $db->query( $query_aggiorna_alias );


}


function controlla_canale($postdata, $xcrud){
    
       $numero_di_canale = $postdata->get('canale');
       $macchina_esercente_id = $postdata->get('macchina_esercente_id');
   	  
	
	$db = Xcrud_db::get_instance();
	
        $query_vedi_canali = "select numero_canali from macchina_esercente where id = $macchina_esercente_id ";
              
	
        $db->query( $query_vedi_canali );
        $result_vedi_canali = $db->result();
        foreach ($result_vedi_canali as $key => $item)
                        {
				            $numero_canali = $item['numero_canali'];
                        }
                        
                if ( $numero_di_canale > $numero_canali) {
                    $xcrud->set_exception('canale','Numero di canale troppo alto, numero massimo = '.$numero_canali,'error');
                }

       // controllo che il canale non sia occupato
       $query_vedi_canale_occupato = "select canale from vetrina_macchina where macchina_esercente_id = $macchina_esercente_id 
        AND canale = $numero_di_canale";

        $canale_occupato = 0;
	
        $db->query( $query_vedi_canale_occupato );
        $result_vedi_canale_occupato = $db->result();
        foreach ($result_vedi_canale_occupato as $key => $item)
                        {
				            $canale_occupato = $item['canale'];
                        }
                        
                if ( $canale_occupato > 0 ) {
                        // Lista canali liberi
                    $html_ritorno = "";
                    $query_vedi_canali_liberi = "SELECT *
                                FROM macchina_esercente_canali
                                WHERE macchina_esercente_canali.alias NOT IN (
                                    SELECT vetrina_macchina.canale
                                    FROM vetrina_macchina
                                )
                                AND macchina_esercente_canali.macchina_esercente_id = $macchina_esercente_id ";
                    $db->query( $query_vedi_canali_liberi );
                    $result_vedi_canali_liberi = $db->result();
                
                    foreach ($result_vedi_canali_liberi as $key => $item)
                            {
                            //  $html_ritorno .= '<p>'. $item['canale'].'</p>';
                                $html_ritorno .= $item['alias']. ' - ';
                            /*     if ( $numero_di_canale == $item['alias'] ) {
                                    $xcrud->set_exception('utente_id','Canale occupato, CANALI LILBERI '.$html_ritorno,'error');
                                } */
                            }



                    $xcrud->set_exception('canale','Numero canale OCCUPATO, canali attualmente LIBERI -> '.$html_ritorno,'error');
                }

        
       

};


function cripta_password($postdata, $primary){
    
    $password_criptata = hash('sha256', $postdata->get('password'));
    $postdata->set('password',   $password_criptata );
    
};

/* function chiave_duplicata( $postdata,$xcrud ){
    
    if (!$postdata) {
        $xcrud->set_exception('catalogo_esercente_id','Prodotto già presente sul canale.');
    }
    
}; */

function crea_json_banner($postdata, $xcrud){
    
    $esercente_id = $postdata->get('id_esercente'); 
    $id_macchina = $postdata->get('id_macchina');  
    
 
    $db = Xcrud_db::get_instance();

      // prendo la matricola che mi serve per poi creare la giusta DIR
      $query_matricola = "SELECT matricola from macchina_esercente 
      WHERE id = $id_macchina";
  
      $db->query( $query_matricola );
      $result_query_matricola = $db->result();
  
      foreach ($result_query_matricola as $key => $item)
              {
                  $matricola_macchina = $item['matricola'];
              }
 
    // $query_dati = "SELECT id,  JSON_ARRAY ( GROUP_CONCAT(images)) as images, enabled from banner           
    $query_dati = "SELECT id, GROUP_CONCAT(images) as images, abilitato as enabled from banner 
    
                    WHERE id_esercente = $esercente_id
                    and id_macchina = $id_macchina
                    GROUP BY id";
           
 
     $db->query( $query_dati );
     $query_dati = $db->result();
     $array_iniziale = array();
     
     foreach ($query_dati as $key => $item)
     {
            $split_images = explode( "," , trim( $item['images']) ) ;
            $query_dati[$key]['images'] = $split_images;  
            $split_images = "";
     
     }
    
                if ( !file_exists( '../../public/jsontomachine/banner/'.$esercente_id.'/'. $matricola_macchina.'/' ) ) {
                                
                    mkdir( '../../public/jsontomachine/banner/'.$esercente_id.'/'. $matricola_macchina.'/' , 0777, true);
                } 

                if ( file_put_contents( '../../public/jsontomachine/banner/'.$esercente_id.'/'. $matricola_macchina.'/'.'/banner.json', json_encode($query_dati))) {
                 
                       return $messaggio = "FILE JSON CREATO CORRETTAMENTE..";
                }
                else { 
                    $xcrud->set_exception('images','ERRORE NELLA CREAZIONE FILE JSON','error');
                }
 
};

function crea_json_rete($postdata, $xcrud){
    
    $esercente_id = $postdata->get('id_esercente'); 
    $id_macchina = $postdata->get('id_macchina');   
    
 
    $db = Xcrud_db::get_instance();

     // prendo la matricola che mi serve per poi creare la giusta DIR
     $query_matricola = "SELECT matricola from macchina_esercente 
     WHERE id = $id_macchina";
 
     $db->query( $query_matricola );
     $result_query_matricola = $db->result();
 
     foreach ($result_query_matricola as $key => $item)
             {
                 $matricola_macchina = $item['matricola'];
             }
 
    $query_dati = "SELECT * from configurazione_rete
     WHERE id_esercente = $esercente_id 
     and id_macchina = $id_macchina ";
           
 
     $db->query( $query_dati );
     $result_query_dati = $db->result();

     foreach ($result_query_dati as $key => $item)
             {
                $array_dati = array(
                    
                        'network'=>array(
                            array(   
                                'localIp_porta'=> $item['localIp_porta'],
                                'localApi_ip'=> $item['localApi_ip'],
                                'localApi_porta'=> $item['localApi_porta'],
                                'cloudApi_ip'=> $item['cloudApi_ip'],
                                'cloudApi_utente'=> $item['cloudApi_utente'],
                                'cloudApi_psw'=> $item['cloudApi_psw'],
                                'cloudApi_token'=> $item['cloudApi_token'],
                                'password'=> $item['password_tecnico'],
                                'indirizzo_email'=> $item['utente_tecnico']
                            )
                        ),
                        'network_system'=>array(
                            array(
                                'localIp_ip'=> $item['IP'],
                                'netmask'=> $item['netmask'],
                                'dns_secondario'=> $item['dns_secondario'],
                                'dns_primario'=> $item['dns_primario'],
                                'gateway'=> $item['gateway'],
                                'dhcp'=> $item['dhcp']
                            )
                        )
                   
                   );
            
                 
            
             }

                if ( !file_exists( '../../public/jsontomachine/rete/'.$esercente_id.'/'.$matricola_macchina.'/' ) ) {
                                
                    mkdir( '../../public/jsontomachine/rete/'.$esercente_id.'/'.$matricola_macchina , 0777, true);
                } 

                if ( file_put_contents( '../../public/jsontomachine/rete/'.$esercente_id.'/'.$matricola_macchina.'/network.json', json_encode($array_dati))) {
                 
                       return $messaggio = "FILE JSON CREATO CORRETTAMENTE..";
                }
                else { 
                    $xcrud->set_exception('images','ERRORE NELLA CREAZIONE FILE JSON','error');
                }
 
};

function crea_json_logs($postdata, $xcrud){
    
    $esercente_id = $postdata->get('id_esercente'); 
    $id_macchina = $postdata->get('id_macchina');   
    
 
    $db = Xcrud_db::get_instance();

     // prendo la matricola che mi serve per poi creare la giusta DIR
     $query_matricola = "SELECT matricola from macchina_esercente 
     WHERE id = $id_macchina";
 
     $db->query( $query_matricola );
     $result_query_matricola = $db->result();
 
     foreach ($result_query_matricola as $key => $item)
             {
                 $matricola_macchina = $item['matricola'];
             }
 
    $query_dati = "SELECT * from logs
                    WHERE id_esercente = $esercente_id 
                    and id_macchina = $id_macchina ";
           
 
     $db->query( $query_dati );
     $result_query_dati = $db->result();

     foreach ($result_query_dati as $key => $item)
             {
                $array_dati = array(
                    array(   
                        'type'=> $item['tipo'],
                        'message'=> array(   
                            'id'=> $item['id_ticket'],
                            'state'=> $item['stato'],
                            'icon'=> $item['icon'],
                            'descrizione'=> $item['descrizione']
                        ),
                        'date'=> $item['dataora']
                    )
                   );
            
             }

                if ( !file_exists( '../../public/jsontomachine/logs/'.$esercente_id.'/'.$matricola_macchina.'/' ) ) {
                                
                    mkdir( '../../public/jsontomachine/logs/'.$esercente_id.'/'.$matricola_macchina , 0777, true);
                } 

                if ( file_put_contents( '../../public/jsontomachine/logs/'.$esercente_id.'/'.$matricola_macchina.'/log.json', json_encode($array_dati))) {
                 
                       return $messaggio = "FILE JSON CREATO CORRETTAMENTE..";
                }
                else { 
                    $xcrud->set_exception('images','ERRORE NELLA CREAZIONE FILE JSON','error');
                }
 
};


function crea_json_catalogo_esercente($postdata, $xcrud){
    
    $esercente_id = $postdata->get('id_esercente'); 
    $id_macchina = $postdata->get('macchina_esercente_id'); 
    $esercente_id = $postdata->get('utente_id'); 
 
    $db = Xcrud_db::get_instance();

    // prendo la matricola che mi serve per poi creare la giusta DIR
    $query_matricola = "SELECT matricola from macchina_esercente 
    WHERE id = $id_macchina";

    $db->query( $query_matricola );
    $result_query_matricola = $db->result();

    foreach ($result_query_matricola as $key => $item)
            {
                $matricola_macchina = $item['matricola'];
            }

 
    $query_dati_catalogo  = "SELECT id,
                                    codice_a_barre,
                                    descrizione,
                                    immagine,
                                    ristretto_per_minori,
                                    vendibile,
                                    vendibile_via_web,
                                    profondita,
                                    prezzo,
                                    prezzo_scontato,
                                    iva_id,
                                    utente_id,
                                    macchina_esercente_id,
                                    catalogo_tipologia_id,
                                    titolo,
                                    minuti

                                    FROM catalogo_esercente "
                                    . "where macchina_esercente_id = $id_macchina;";
           
 
     $db->query( $query_dati_catalogo );
     $result_dati_catalogo = $db->result();

                if ( !file_exists( '../../public/jsontomachine/cataloghiesercenti/'.$esercente_id.'/'.$matricola_macchina.'/' ) ) {
                                
                    mkdir( '../../public/jsontomachine/cataloghiesercenti/'.$esercente_id.'/'.$matricola_macchina , 0777, true);
                } 

                if ( file_put_contents( '../../public/jsontomachine/cataloghiesercenti/'.$esercente_id.'/'.$matricola_macchina.'/catalogoesercente.json', json_encode($result_dati_catalogo))) {
                 
                       return $messaggio = "FILE JSON CREATO CORRETTAMENTE..";
                }
                else { 
                    $xcrud->set_exception('images','ERRORE NELLA CREAZIONE FILE JSON','error');
                }
 
};

function crea_json_catalogogenerale($postdata, $xcrud){
    
  //  $esercente_id = $postdata->get('id_esercente'); 
  
    $db = Xcrud_db::get_instance();

 
    $query_dati_catalogo  = "SELECT *
                                    FROM catalogo_generale ";
           
 
     $db->query( $query_dati_catalogo );
     $query_dati_catalogo = $db->result();

                if ( !file_exists( '../../public/jsontomachine/catalogogenerale/' ) ) {
                                
                    mkdir( '../../public/jsontomachine/catalogogenerale/' , 0777, true);
                } 

                if ( file_put_contents( '../../public/jsontomachine/catalogogenerale/catalogogenerale.json', json_encode($query_dati_catalogo))) {
                 
                       return $messaggio = "FILE JSON CREATO CORRETTAMENTE..";
                }
                else { 
                    $xcrud->set_exception('images','ERRORE NELLA CREAZIONE FILE JSON','error');
                }
 
};

function crea_json_ticket($postdata, $xcrud){
    
      $esercente_id = $postdata->get('id_esercente'); 
      $id_macchina = $postdata->get('id_macchina'); 

      // devo prendere ID macchina prendendola dalla matricola
      
      $db = Xcrud_db::get_instance();

      $query_id_macchina = "select matricola from macchina_esercente where id = '$id_macchina' ";
      $db->query( $query_id_macchina );
      $result_id_macchina = $db->result();

        foreach ($result_id_macchina as $key => $item)
            {
                $matricola_macchina = $item['matricola'];
            } 
  
  
      $query_dati_tickets  = "SELECT * FROM tickets
                                where  id_esercente = $esercente_id 
                                and id_macchina = $id_macchina ";
             
   
       $db->query( $query_dati_tickets );
       $result_dati_tickets = $db->result();
  
                  if ( !file_exists( '../../public/jsontomachine/contabilita/'.$esercente_id.'/'.$matricola_macchina.'/' ) ) {
                                  
                      mkdir( '../../public/jsontomachine/contabilita/'.$esercente_id.'/'.$matricola_macchina.'/' , 0777, true);
                  } 
  
                  if ( file_put_contents( '../../public/jsontomachine/contabilita/'.$esercente_id.'/'.$matricola_macchina.'/tickets.json', json_encode($result_dati_tickets))) {
                   
                         return $messaggio = "FILE JSON CREATO CORRETTAMENTE..";
                  }
                  else { 
                      $xcrud->set_exception('id_ticket','ERRORE NELLA CREAZIONE FILE JSON','error');
                  }
            
   
  };

function crea_json_configurazione_macchina($postdata, $xcrud){
    
    $esercente_id = $postdata->get('id_esercente'); 
    $id_macchina = $postdata->get('id_macchina');   
    
 
    $db = Xcrud_db::get_instance();

     // prendo la matricola che mi serve per poi creare la giusta DIR
     $query_matricola = "SELECT matricola from macchina_esercente 
     WHERE id = $id_macchina";
 
     $db->query( $query_matricola );
     $result_query_matricola = $db->result();
 
     foreach ($result_query_matricola as $key => $item)
             {
                 $matricola_macchina = $item['matricola'];
             }
 
    $query_dati = "SELECT * from configurazione_macchina
     WHERE id_esercente = $esercente_id 
     and id_macchina = $id_macchina ";
           
 
     $db->query( $query_dati );
     $result_query_dati = $db->result();

     foreach ($result_query_dati as $key => $item)
             {
                $array_dati = array(
                    
                        'behavior'=>array(
                            array(   
                                'pay_before_selection'=> $item['pay_before_selection'],
                                'limitazioni_eta'=> $item['limitazioni_eta'],
                                'vetrina_digitale'=> $item['vetrina_digitale'],
                                'continua_vendita'=> $item['continua_vendita']
                            )
                        ),
                        'generali'=>array(
                            array(
                                'default_lang'=> $item['default_lang'],
                                'id_macchina'=> $item['id_macchina'],
                                'id_esercente'=> $item['id_esercente'],
                                'matricola'=> $matricola_macchina,
                                'resto_max'=> $item['resto_max'],
                                'resto_abilitato'=> $item['resto_abilitato'],
                                'timer_vendita'=> $item['timer_vendita'],
                                'timer_manager'=> $item['timer_manager'],
                                'timer_pagina_principale'=> $item['timer_pagina_principale'],
                                'validita_ticket_settimane'=> $item['validita_ticket_settimane']
                            )
                        ),
                        'info_venditore'=>array(
                            array(
                                'nome_venditore'=> $item['nome_venditore'],
                                'indirizzo_venditore'=> $item['indirizzo_venditore'],
                                'localita_venditore'=> $item['localita_venditore'],
                                'email_venditore'=>  $item['email_venditore'],
                                'telefono_venditore'=>  $item['telefono_venditore'],
                                'fax_venditore'=> $item['fax_venditore'],
                                'orario_lun'=> $item['orario_lun'],
                                'orario_mar'=> $item['orario_mar'],
                                'orario_mer'=> $item['orario_mer'],
                                'orario_gio'=> $item['orario_gio'],
                                'orario_ven'=> $item['orario_ven'],
                                'orario_sab'=> $item['orario_sab'],
                                'orario_dom'=> $item['orario_dom']
                            )
                        ),
                        'stampe'=>array(
                            array(
                                'esercente'=> $item['esercente'],
                                'indirizzo'=> $item['indirizzo'],
                                'localita'=> $item['localita'],
                                'telefono'=>  $item['telefono'],
                                'testo_contanti'=> $item['testo_contanti'],
                                'testo_prezzo'=> $item['testo_prezzo'],
                                'testo_resto'=> $item['testo_resto'],
                                'testo_credito_rimanente'=> $item['testo_credito_rimanente'],
                                'testo_generico1'=> $item['testo_generico1'],
                                'testo_generico2'=> $item['testo_generico2'],
                                'testo_generico3'=> $item['testo_generico3'],
                                'testo_generico4'=> $item['testo_generico4']
                            )
                        ),
                        'vetrina'=>array(
                            array(
                                'layout'=> $item['layout'],
                                'layout_card'=> $item['layout_card']
                            )
                        )
                   
                   );
            
                 
            
             }

                if ( !file_exists( '../../public/jsontomachine/configurazione_macchina/'.$esercente_id.'/'.$matricola_macchina.'/' ) ) {
                                
                    mkdir( '../../public/jsontomachine/configurazione_macchina/'.$esercente_id.'/'.$matricola_macchina , 0777, true);
                } 

                if ( file_put_contents( '../../public/jsontomachine/configurazione_macchina/'.$esercente_id.'/'.$matricola_macchina.'/config.json', json_encode($array_dati))) {
                 
                       return $messaggio = "FILE JSON CREATO CORRETTAMENTE..";
                }
                else { 
                    $xcrud->set_exception('id_macchina','ERRORE NELLA CREAZIONE FILE JSON','error');
                }
 
};