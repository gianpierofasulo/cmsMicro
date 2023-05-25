<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';
require_once $config['CLASS_PATH'] . 'class_macchine.php';

$macchine = new Macchina;

if ( $_SESSION['utente_id_ruolo'] > 2 ) {
    $elenco_macchine = $macchine->vedi_macchine($_SESSION['utente_id']);
  } else {
    $elenco_macchine = $macchine->vedi_macchine_admin();
  }


$QueryAND = '';
$id_macchina = 0;
$nomeProdotto = '';

if ( isset( $_POST['macchina_id'] ) && $_POST['macchina_id'] > 0 ) {
   $id_macchina = $_POST['macchina_id'];
   $QueryAND = ' AND macchina_esercente_id = '.$id_macchina;
}
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('vetrina_macchina');
        
           
        //    $xcrud->set_logging(true);
            $xcrud->table_name('Gestione Vetrine Macchine Esercenti');

            if ( isset( $_POST['macchina_id'] ) ) {
                $id_macchina = $_POST['macchina_id'];
                $xcrud->where(' macchina_esercente_id = '.$id_macchina);
            }

            $xcrud->unset_view();
            
             if ( $_SESSION['utente_id_ruolo'] > 2 ) {
                // Privatizzoo per esercenti
                $xcrud->where('utente_id ='.$_SESSION['utente_id']);
                $xcrud->relation('macchina_esercente_id','macchina_esercente','id',array('matricola','ip'),array('utente_id' => $_SESSION['utente_id']) );
                $xcrud->relation('catalogo_esercente_id','catalogo_esercente','id',array('codice_a_barre','titolo'),array('utente_id' => $_SESSION['utente_id']) );
                
              
                $xcrud->pass_var('utente_id', $_SESSION['utente_id']);
                $xcrud->fields('utente_id', true);
                $xcrud->columns('utente_id', true);
            } else {
                $xcrud->relation('catalogo_esercente_id','catalogo_esercente','id',array('codice_a_barre','titolo'));
                $xcrud->relation('macchina_esercente_id','macchina_esercente','id',array('matricola','ip') );
                $xcrud->relation('utente_id','utente','id',array('cognome','nome'),array('ruolo_id' => 3) );
               
                $xcrud->label('utente_id','Esercente');
            }

            $xcrud->relation('canale','macchina_esercente_canali','canale',array('canale'));
        
    
       //     $xcrud->button('?page=vetrina_assegna_prodotto','Assegna Prodotto','glyphicon glyphicon-plus','',array('target'=>'_self','style'=>'color: #FFFFFF; border-color: #428bca'));
       

                $xcrud->unset_add();
                $xcrud->disabled('macchina_esercente_id');

//            $xcrud->unset_edit();
//            $xcrud->unset_remove();
//             $xcrud->change_type('attivo', 'select', '', array('values' => 
//                                        array(0 => 'NO', 1 => 'SI'))
//                                );
             
             $xcrud->label('catalogo_esercente_id','Prodotto');
             $xcrud->label('macchina_esercente_id','Macchina');
         
//             $xcrud->highlight('validata','=','1','#11d911');



