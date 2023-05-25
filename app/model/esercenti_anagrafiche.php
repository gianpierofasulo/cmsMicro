<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('esercente');
 //           $xcrud->set_logging(true);
//            $xcrud->unset_add();
//            $xcrud->unset_edit();
            $xcrud->unset_remove();
            
            $xcrud->table_name('Gestione Esercenti');
            
             $xcrud->relation('utente_id','utente','id',array('cognome','nome'),array('ruolo_id' => 3) );
             $xcrud->relation('comune_id','comune','id',array('comune','provincia','cap'));
             
//             $xcrud->change_type('attivo', 'select', '', array('values' => 
//                                        array(0 => 'NO', 1 => 'SI'))
//                                );
             
             $xcrud->label('utente_id','Esercente');
             $xcrud->label('comune_id','Comune/Prov/Cap');
             
//             $xcrud->highlight('validata','=','1','#11d911');