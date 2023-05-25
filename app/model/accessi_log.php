<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('utente_login');
            
            $xcrud->unset_add();
            $xcrud->unset_edit();
            $xcrud->unset_remove();
            
            $xcrud->table_name('Log Accessi');
            
            $xcrud->relation('utente_id','utente','id',array('cognome','nome'));
         
            $xcrud->label('utente_id','UTENTE');
            
              $xcrud->change_type('validata', 'select', '', array('values' => 
                                        array(0 => 'NO', 1 => 'SI'))
                                );
             $xcrud->highlight('validata','=','1','#11d911');
            $xcrud->order_by('id','desc');