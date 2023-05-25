<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('configurazione_rete');

           

//            $xcrud->unset_add();
//            $xcrud->unset_edit();
              if ( $_SESSION['utente_id_ruolo'] > 2 ) {
                $id_esercente = $_SESSION['utente_id'];
                    // $xcrud->unset_remove();
                    $xcrud->where('id_esercente ='.$id_esercente);
                    $xcrud->relation('id_macchina','macchina_esercente','id',array('matricola','ip'),array('utente_id'=>$id_esercente));
                     // hide columns
                    $xcrud->columns('id_esercente', true);
                    $xcrud->fields('id_esercente', true);

                    $xcrud->pass_var('id_esercente',$id_esercente);
              } else {
                $xcrud->relation('id_macchina','macchina_esercente','id',array('matricola','ip'));
                $xcrud->relation('id_esercente','utente','id',array('cognome','nome'));
              }
            
            $xcrud->table_name('Gestione RETE');
            
           /*  $xcrud->relation('iva_id','iva','id',array('descrizione') );  */
          
            
            
             $xcrud->change_type('dhcp', 'select', '', array('values' => 
                                        array('1' => 'SI', '0' => 'NO'))
                                ); 

                                
            //  $xcrud->change_type('images','image',''); 
            /*  $xcrud->label('id','ID banner');
             $xcrud->label('images','Immagini');
             $xcrud->label('enabled','Abilitato'); */

             $xcrud->after_insert('crea_json_rete');
             $xcrud->after_update ('crea_json_rete');
             
            
         
//             $xcrud->highlight('validata','=','1','#11d911');