<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('tickets');

           

            $xcrud->unset_add();
            $xcrud->unset_remove();
//            $xcrud->unset_edit();
              if ( $_SESSION['utente_id_ruolo'] > 2 ) {
                        $id_esercente = $_SESSION['utente_id'];
                        $xcrud->where('id_esercente ='.$id_esercente);

                        // hide columns
                        $xcrud->columns('id_esercente,tipo', true);
                        $xcrud->fields('id_esercente,tipo', true);
                        $xcrud->relation('id_macchina','macchina_esercente','id',array('matricola'),array('utente_id'=>$id_esercente));

                        $xcrud->pass_var('id_esercente',$id_esercente);
              } else {
                        $xcrud->relation('id_macchina','macchina_esercente','id',array('matricola'));
                        $xcrud->relation('id_esercente','utente','id',array('cognome','nome'));
              }
            
            $xcrud->table_name('Gestione TICKETS');
            
           /*  $xcrud->relation('iva_id','iva','id',array('descrizione') );  */
        
            
            
       //     $xcrud->change_type('credito', 'price', '5', array('prefix'=>'€ ' , 'separator'=> ',' ));
       //     $xcrud->column_pattern('credito','EURO {value}' );

            // chiamo la callback per dividere l'importo / 100 dato che in tabella è inserito in centesimi di euro l'importo
            $xcrud->column_callback('credito','dividi_importo_credito');

            $xcrud->column_callback('id_ticket','vedi_date_ticket');
       
            $xcrud->change_type('dataticket', 'datetime');   
            $xcrud->change_type('validity', 'datetime');  

            //  $xcrud->change_type('images','image',''); 
             $xcrud->label('dataticket','Emissione');
             $xcrud->label('validity','Scadenza');
             $xcrud->label('id_ticket','N. Ticket');
             $xcrud->label('id_macchina','Macchina');
             $xcrud->label('abilitato','Annulla');

             $xcrud->disabled('id_ticket,dataticket,validity,credito,tipo');

             $xcrud->change_type('abilitato', 'select', '', array('values' => 
                                array('true' => 'SI', 'false' => 'NO'))
                        ); 



             $xcrud->after_insert('crea_json_ticket');
             $xcrud->after_update ('crea_json_ticket');

         
             
          
         
//             $xcrud->highlight('validata','=','1','#11d911');