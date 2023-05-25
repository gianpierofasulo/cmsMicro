<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('utente');
            
//            $xcrud->unset_add();
//            $xcrud->unset_edit();
            $xcrud->unset_remove();
            
            $xcrud->table_name('Gestione Accessi');
            
//            $xcrud->relation('utente_id','utente','id',array('cognome','nome'),array('tipo_utente' => 1));
             $xcrud->relation('ruolo_id','ruolo','id',array('descrizione'));
             
             $xcrud->change_type('attivo', 'select', '', array('values' => 
                                        array(0 => 'NO', 1 => 'SI'))
                                );
             
//             $xcrud->label('utente_id','UTENTE');
             
//             $xcrud->highlight('validata','=','1','#11d911');