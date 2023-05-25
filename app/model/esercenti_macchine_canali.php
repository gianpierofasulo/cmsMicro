<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';

require_once $config['CLASS_PATH'] . 'class_prodotti.php';
require_once $config['CLASS_PATH'] . 'class_macchine.php';

$macchine = new Macchina;
$elenco_macchine = $macchine->vedi_macchine($_SESSION['utente_id']);
$QueryAND = '';
$id_macchina = 0;
$nomeProdotto = '';

if ( isset( $_POST['macchina_id'] ) && $_POST['macchina_id'] > 0 ) {
   $id_macchina = $_POST['macchina_id'];
   $QueryAND = ' AND macchina_esercente_id = '.$id_macchina;
}

 	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('macchina_esercente_canali');

             if ( isset( $_POST['macchina_id'] ) ) {
               $id_macchina = $_POST['macchina_id'];
               $xcrud->where(' macchina_esercente_id = '.$id_macchina);
           }
         
 
//            $xcrud->unset_add();
//            $xcrud->unset_edit();
            $xcrud->unset_remove();
            $xcrud->unset_view();
            
            $xcrud->table_name( 'Gestione Canali (Lista canali abilitati per macchina)' );

            if ( $_SESSION['utente_id_ruolo'] > 2 ) {
               // Privatizzoo per esercenti
               $xcrud->where('id_esercente ='.$_SESSION['utente_id']);
               $xcrud->fields('id_esercente', true);
               $xcrud->columns('id_esercente', true);
           }

       
            $xcrud->relation('macchina_esercente_id','macchina_esercente','id',array('matricola'),array('utente_id = ' => $_SESSION['utente_id']) );
 /*            $xcrud->relation('comune_id','comune','id',array('comune','provincia','cap')); */
      
           /*      $xcrud->change_type('stato', 'select', '', array('values' => 
                array(0 => 'DISABILITATO', 1 => 'ABILITATO'))
                ); */
             
             $xcrud->label('macchina_esercente_id','Matricola');
 //            $xcrud->label('comune_id','Comune/Prov/Cap');
             
             $xcrud->highlight('stato','=','Abilitato','#63cf80');

             $xcrud->disabled('canale','edit','riga');
             $xcrud->disabled('riga','edit');

             // controllo eventuali duplicazioni canale/prodotto/macchina
             $xcrud->before_insert('controlla_canale');
             
            

             // dopo update bisogna aggiornare i dati in quanto l'utente potrebbe aver modificato l'alias
             // per cui nella tabella vetrina va agganciato il nuovo alias per quel prodotto
    //*         $xcrud->after_update('aggiorna_alias_vetrina');


             
             