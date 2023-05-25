<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('log_operazioni');

           

            $xcrud->unset_add();
            $xcrud->unset_remove();
            $xcrud->unset_edit();
              if ( $_SESSION['utente_id_ruolo'] > 2 ) {
                    $id_esercente = $_SESSION['utente_id'];
                    $xcrud->where('id_esercente ='.$id_esercente);
                    $xcrud->relation('id_macchina','macchina_esercente','id',array('matricola'),array('utente_id'=>$id_esercente));
                    // hide columns
                    $xcrud->columns('id_esercente', true);
                    $xcrud->fields('id_esercente', true);

                    $xcrud->pass_var('id_esercente',$id_esercente);
              } else {
                $xcrud->relation('id_macchina','macchina_esercente','id',array('matricola'));
                $xcrud->relation('id_esercente','utente','id',array('cognome','nome'));
              }
            
            $xcrud->table_name('RECOVERY JSON FILE');
            
           
            $xcrud->change_type('data_ora', 'datetime');   
            

            //  $xcrud->change_type('images','image',''); 
             $xcrud->label('dataora','Data/ORA');
             $xcrud->label('id_macchina','Matricola');
             $xcrud->label('endpoint_richiamato','Servizio');
             $xcrud->label('json_file','File JSON');
            

             $xcrud->disabled('id_ticket,dataticket,validity,credito');

          /*    $xcrud->change_type('abilitato', 'select', '', array('values' => 
                                array('true' => 'SI', 'false' => 'NO'))
                        );  */
