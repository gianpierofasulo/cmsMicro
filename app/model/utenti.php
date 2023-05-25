<?php

    	 require_once $config['XCRUD_PATH'] . 'xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('utente_login');
            $xcrud->set_logging(true);
            
            $xcrud->unset_add();
            $xcrud->unset_edit();
            $xcrud->unset_remove();
            
            $xcrud->table_name('LOGIN');
            
        //    $xcrud->relation('utente_id','utente','id',array('cognome','nome'),array('tipo_utente' => 1));
             $xcrud->relation('utente_id','utente','id',array('cognome','nome'));
             

             
             $xcrud->change_type('validata', 'select', '', array('values' => 
                                        array(0 => 'NO', 1 => 'SI'))
                                );
             
             $xcrud->label('utente_id','UTENTE');
             
             $xcrud->highlight('validata','=','1','#11d911');