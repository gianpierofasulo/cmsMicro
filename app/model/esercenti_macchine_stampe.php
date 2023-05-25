<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';


 	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('configurazione_macchina');

     
 
//            $xcrud->unset_add();
//            $xcrud->unset_edit();
            $xcrud->unset_remove();
            $xcrud->unset_view();
            
            $xcrud->table_name( 'Gestione configurazioni stampe' );

            if ( $_SESSION['utente_id_ruolo'] > 2 ) {
               // Privatizzoo per esercenti
               $xcrud->where('id_esercente ='.$_SESSION['utente_id']);
               $xcrud->fields('id_esercente', true);
               $xcrud->columns('id_esercente', true);
           }

       
            $xcrud->relation('id_macchina','macchina_esercente','id',array('matricola'),array('utente_id = ' => $_SESSION['utente_id']) );
 /*            $xcrud->relation('comune_id','comune','id',array('comune','provincia','cap')); */
      
             
            /*     $xcrud->change_type('gruppo_tastierino', 'select', '', array('values' => 
                                 array(0 => 'DISABILITATO', 1 => 'ABILITATO'))
                ); */
             
             $xcrud->label('id_macchina','Matricola macchina');

             $xcrud->pass_var('id_esercente',$_SESSION['utente_id']);


             $xcrud->fields('nome_venditore,indirizzo_venditore,localita_venditore,
                              email_venditore,telefono_venditore,fax_venditore,
                              orario_lun,orario_mar,orario_mer,orario_gio,
                              orario_ven,orario_sab,orario_dom,
                              pay_before_selection,limitazioni_eta,
                              vetrina_digitale,continua_vendita,
                              gruppo_tastierino,default_lang,
                              matricola,resto_max,resto_abilitato,timer_vendita,
                              timer_manager,timer_pagina_principale,
                              validita_ticket_settimane,volume_interfaccia,
                              layout,layout_card', true);
            $xcrud->columns('nome_venditore,indirizzo_venditore,localita_venditore,
                              email_venditore,telefono_venditore,fax_venditore,
                              orario_lun,orario_mar,orario_mer,orario_gio,
                              orario_ven,orario_sab,orario_dom,
                              pay_before_selection,limitazioni_eta,
                              vetrina_digitale,continua_vendita,
                              gruppo_tastierino,default_lang,
                              matricola,resto_max,resto_abilitato,timer_vendita,
                              timer_manager,timer_pagina_principale,
                              validita_ticket_settimane,volume_interfaccia,
                              layout,layout_card', true);

                              $xcrud->pass_var('id_esercente',$_SESSION['utente_id']);

                              $xcrud->after_insert('crea_json_configurazione_macchina');
                              $xcrud->after_update ('crea_json_configurazione_macchina');

 //            $xcrud->label('comune_id','Comune/Prov/Cap');
             
           /*   $xcrud->highlight('stato','=','Abilitato','#63cf80');

             $xcrud->disabled('canale','edit'); */

          
             