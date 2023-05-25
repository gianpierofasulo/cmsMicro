<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('media');
            
//            $xcrud->unset_add();
//            $xcrud->unset_edit();
//            $xcrud->unset_remove();
            
            
            $xcrud->table_name('Gestione Media');
       //     $xcrud->set_logging(true);

            if ( $_SESSION['utente_id_ruolo'] > 2 ) {
                // Privatizzoo per esercenti
                $xcrud->where('id_esercente ='.$_SESSION['utente_id']);
                $xcrud->fields('id_esercente, timestamp',true);
                $xcrud->columns('id_esercente',true); 

                // se la cartella non esiste veiene creata automaticamente
                $xcrud->change_type('immagine', 'file','', array('path'=>'../../public/media/'. $_SESSION['utente_id'] , 'not_rename'=>true) );

             /*    $xcrud->change_type('immagine', 'file','', array('not_rename'=>true),
                                     array('path'=>'../../public/media/'. $_SESSION['utente_id'], 
                                     
                                    ),
                                      ); */
             
            } else { 
                // ADMIN può solo vedere
                $xcrud->unset_add();
                $xcrud->relation('id_esercente','utente','id',array('cognome','nome'),array('ruolo_id' => 3) );
                $xcrud->fields('timestamp',true);
               // $xcrud->columns('id_esercente',true); 
               // $xcrud->disabled('video,immagine'); 
            }


            $xcrud->order_by('timestamp','desc');
            
           /*   $xcrud->relation('utente_id','utente','id',array('cognome','nome'),array('ruolo_id' => 3) );
             $xcrud->relation('tipologia_id','catalogo_tipologia','id',array('descrizione')); */
           

            
          /*    $canali = $xcrud->nested_table('Canali abilitati','id','macchina_esercente_canali','macchina_esercente_id'); 
             $canali->table_name('Canali Abilitati');
             $canali->unset_remove(); */
             
            /*  $canali->change_type('stato', 'select', '', array('values' => 
                                        array(0 => 'DISABILITATO', 1 => 'ABILITATO'))
                                ); */

        
         

        $xcrud->pass_var('id_esercente',$_SESSION['utente_id']);

        $xcrud->label('timestamp','Data/ora');
        $xcrud->label('immagine','Nome file'); 
        
        $xcrud->before_remove('cancella_files');

        

  