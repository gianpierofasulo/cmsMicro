<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('catalogo_programmi_washing');
            
//            $xcrud->unset_add();
//            $xcrud->unset_edit();
            $xcrud->unset_remove();
            
            $xcrud->table_name('Programmi Washing Machines');
            
             $xcrud->relation('id_catalogo_generale','catalogo_generale','id',array('descrizione','prezzo'),array('catalogo_tipologia_id' => 1) );
             $xcrud->relation('id_catalogo_step_washing','catalogo_step_washing','id',array('descrizione'));
             
//             $xcrud->change_type('attivo', 'select', '', array('values' => 
//                                        array(0 => 'NO', 1 => 'SI'))
//                                );
             
             $xcrud->label('id_catalogo_generale','Nome programma/prezzo');
             $xcrud->label('id_catalogo_step_washing','Descrizione/step');
//             $xcrud->column_cut(200,'descrizione');
         
//             $xcrud->highlight('validata','=','1','#11d911');