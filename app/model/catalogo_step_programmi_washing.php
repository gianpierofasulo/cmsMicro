<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('catalogo_step_washing');
            
//            $xcrud->unset_add();
//            $xcrud->unset_edit();
            $xcrud->unset_remove();
            
            $xcrud->table_name('Gestione Step Washing Machines');
            
 //            $xcrud->relation('utente_id','utente','id',array('cognome','nome'),array('ruolo_id' => 3) );
 //            $xcrud->relation('comune_id','comune','id',array('comune','provincia','cap'));
             
//             $xcrud->change_type('attivo', 'select', '', array('values' => 
//                                        array(0 => 'NO', 1 => 'SI'))
//                                );
             
             $xcrud->label('descrizione','Descrizione degli step');
             $xcrud->column_cut(200,'descrizione');
         
//             $xcrud->highlight('validata','=','1','#11d911');