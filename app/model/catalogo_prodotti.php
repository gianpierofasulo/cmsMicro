<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('catalogo_generale');

//            $xcrud->unset_add();
//            $xcrud->unset_edit();
              if ( $_SESSION['utente_id_ruolo'] > 2 ) {
                    $xcrud->unset_remove();
              }
            
             $xcrud->table_name('Gestione Catalogo Prodotti');
            
             $xcrud->relation('iva_id','iva','id',array('descrizione') );
             $xcrud->relation('catalogo_tipologia_id','catalogo_tipologia','id',array('descrizione'));
             
             $xcrud->change_type('ristretto_per_minori', 'select', '', array('values' => 
                                        array(0 => 'NO', 1 => 'SI'))
                                );
             $xcrud->change_type('vendibile', 'select', '', array('values' => 
                                        array(0 => 'NO', 1 => 'SI'))
                                );
             $xcrud->change_type('vendibile_via_web', 'select', '', array('values' => 
                                        array(0 => 'NO', 1 => 'SI'))
                                );
             $xcrud->change_type('immagine','image',''); 
             $xcrud->label('iva_id','% IVA');
             $xcrud->label('catalogo_tipologia_id','Tipo macchina');
             
             // hide columns
             $xcrud->columns('descrizione,ristretto_per_minori,vendibile,vendibile_via_web', true);

             $xcrud->after_insert('crea_json_catalogogenerale');
             $xcrud->after_update ('crea_json_catalogogenerale');
         

         //    $xcrud->pass_var('id_esercente',$id_esercente);
         
//             $xcrud->highlight('validata','=','1','#11d911');