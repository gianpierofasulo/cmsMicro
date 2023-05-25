<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('logs');

           
            $xcrud->unset_add();
            $xcrud->unset_remove();
       //     $xcrud->unset_edit();
              if ( $_SESSION['utente_id_ruolo'] > 2 ) {
                    $id_esercente = $_SESSION['utente_id'];

                    $xcrud->where('id_esercente ='.$id_esercente);

                    $xcrud->relation('id_macchina','macchina_esercente','id',array('matricola'),array('utente_id'=>$id_esercente));

                    $xcrud->pass_var('id_esercente',$id_esercente);
                     // hide columns
                    $xcrud->columns('id_esercente,icon', true);
                    $xcrud->fields('id_esercente,icon', true);

              } else {
                $xcrud->relation('id_macchina','macchina_esercente','id',array('matricola'));
                $xcrud->relation('id_esercente','utente','id',array('cognome','nome'));
              }
            
            $xcrud->table_name('LOG TRANSAZIONI');
            
           /*  $xcrud->relation('iva_id','iva','id',array('descrizione') );  */
          
            
       
            // chiamo la callback per dividere l'importo / 100 dato che in tabella è inserito in centesimi di euro l'importo
            // $xcrud->column_callback('credito','dividi_importo_credito');

            // $xcrud->column_callback('id_ticket','vedi_date_ticket');
       
            $xcrud->change_type('dataora', 'datetime');   
            

            //  $xcrud->change_type('images','image',''); 
             $xcrud->label('dataora','Data/ORA');
             $xcrud->label('id_macchina','Matricola');
            

             $xcrud->disabled('id_ticket,tipo,stato,dataora');

          /*    $xcrud->change_type('abilitato', 'select', '', array('values' => 
                                array('true' => 'SI', 'false' => 'NO'))
                        );  */



             $xcrud->after_insert('crea_json_logs');
             $xcrud->after_update ('crea_json_logs');

         
            

        
          
         
//             $xcrud->highlight('validata','=','1','#11d911');