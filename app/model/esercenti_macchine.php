<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('macchina_esercente');
            
//            $xcrud->unset_add();
//            $xcrud->unset_edit();
            $xcrud->unset_remove();
            
            
            $xcrud->table_name('Gestione Macchine Esercenti');
            
             $xcrud->relation('utente_id','utente','id',array('cognome','nome'),array('ruolo_id' => 3) );
             $xcrud->relation('tipologia_id','catalogo_tipologia','id',array('descrizione'));
             $xcrud->relation('id','macchina_esercente_canali','macchina_esercente_id');

            
             $canali = $xcrud->nested_table('Canali abilitati','id','macchina_esercente_canali','macchina_esercente_id'); 
             $canali->table_name('Canali Abilitati');
             $canali->unset_remove();
             
             $canali->change_type('stato', 'select', '', array('values' => 
                                        array(0 => 'DISABILITATO', 1 => 'ABILITATO'))
                                );
             
             $xcrud->label('utente_id','Esercente');
             $xcrud->label('tipologia_id','Tipo macchina');

             $canali->label('canale','N. Canale');

            $canali->fields('macchina_esercente_id',true);
            $canali->columns('macchina_esercente_id',true);

            $canali->before_insert('controlla_canale');

            $xcrud->after_insert('inserisci_canali_vuoti');
         
//             $xcrud->highlight('validata','=','1','#11d911');