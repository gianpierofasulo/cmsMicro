<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';


 	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('configurazione_macchina');

     
 
//            $xcrud->unset_add();
//            $xcrud->unset_edit();
            $xcrud->unset_remove();
            $xcrud->unset_view();
            
            $xcrud->table_name( 'Gestione configurazioni macchine' );

            if ( $_SESSION['utente_id_ruolo'] > 2 ) {
               // Privatizzoo per esercenti
               $xcrud->where('id_esercente ='.$_SESSION['utente_id']);
               $xcrud->fields('id_esercente', true);
               $xcrud->columns('id_esercente', true);
           }

       
            $xcrud->relation('id_macchina','macchina_esercente','id',array('matricola'),array('utente_id = ' => $_SESSION['utente_id']) );
 /*            $xcrud->relation('comune_id','comune','id',array('comune','provincia','cap')); */
      
                $xcrud->change_type('pay_before_selection', 'select', '', array('values' => 
                                 array(0 => 'DISABILITATO', 1 => 'ABILITATO'))
                );
                $xcrud->change_type('limitazioni_eta', 'select', '', array('values' => 
                                 array(0 => 'DISABILITATO', 1 => 'ABILITATO'))
                );
                $xcrud->change_type('vetrina_digitale', 'select', '', array('values' => 
                                 array(0 => 'DISABILITATO', 1 => 'ABILITATO'))
                );
                $xcrud->change_type('continua_vendita', 'select', '', array('values' => 
                                 array(0 => 'DISABILITATO', 1 => 'ABILITATO'))
                );
             
             
             $xcrud->label('id_macchina','Matricola macchina');

             $xcrud->pass_var('id_esercente',$_SESSION['utente_id']);

             $xcrud->after_insert('crea_json_configurazione_macchina');
             $xcrud->after_update ('crea_json_configurazione_macchina');

 

           $xcrud->fields('esercente, indirizzo, localita,
                           telefono, testo_contanti, testo_prezzo,
                           testo_resto, testo_credito_rimanente, testo_generico1,
                           testo_generico2, testo_generico3, testo_generico4', true);
            $xcrud->columns('esercente, indirizzo, localita,
                           telefono, testo_contanti, testo_prezzo,
                           testo_resto, testo_credito_rimanente, testo_generico1,
                           testo_generico2, testo_generico3, testo_generico4', true);
             
             