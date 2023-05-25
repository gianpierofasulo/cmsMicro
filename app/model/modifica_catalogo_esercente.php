<?php
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';

require_once $config['CLASS_PATH'] . 'class_prodotti.php';
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

if ( isset( $_POST['nomeProdotto'] ) ) {
   $nomeProdotto = $_POST['nomeProdotto'];
   $QueryAND .= ' AND titolo like "'.$nomeProdotto.'%"';
} 



            $xcrud = Xcrud::get_instance();
            $xcrud->table('catalogo_esercente');
            $xcrud->order_by('macchina_esercente_id');
     //       $xcrud->set_logging(true);
            
            
            if ( $_SESSION['utente_id_ruolo'] > 2 ) {
                // Privatizzoo per esercenti
               
                if ( isset( $_POST['macchina_id'] ) ) {
                    $id_macchina = $_POST['macchina_id'];
                    $xcrud->where('utente_id ='.$_SESSION['utente_id'].$QueryAND);
                }
            } else {
              // ADMIN
              if ( isset( $_POST['macchina_id'] ) ) {
                $id_macchina = $_POST['macchina_id'];
                $xcrud->where(' macchina_esercente_id = '.$id_macchina);
            }
            }



            $xcrud->unset_add();
//            $xcrud->unset_edit();
//            $xcrud->unset_remove();
            
            
           $xcrud->table_name('Gestione Catalogo Prodotti');
            
             $xcrud->relation('iva_id','iva','id',array('descrizione') );
             $xcrud->relation('macchina_esercente_id','macchina_esercente','id',array('matricola','ip'));
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
             $xcrud->label('macchina_esercente_id','Matricola-IP');
             
             $xcrud->label('catalogo_tipologia_id','Tipologia');
             $xcrud->column_width('catalogo_tipologia_id','5%');
             $xcrud->column_width('iva_id','3%');
             $xcrud->column_width('prezzo','3%');
             $xcrud->column_width('macchina_esercente_id','120px');
             $xcrud->column_width('larghezza','85px');
             $xcrud->column_width('profondita','3%');
             
              if ( $_SESSION['utente_id_ruolo'] > 2 ) {
                $xcrud->fields('utente_id', true);
                $xcrud->columns('utente_id', true);
              } else {
                  $xcrud->relation('utente_id','utente','id',array('cognome','nome'),array('ruolo_id' => 3) ); 
                   $xcrud->label('utente_id','Esercente');
              }

              $xcrud->pass_var('utente_id',$_SESSION['utente_id']);
             
             
             // hide columns
             $xcrud->columns('descrizione,ristretto_per_minori,vendibile,vendibile_via_web', true);

             $xcrud->after_insert('crea_json_catalogo_esercente');
             $xcrud->after_update ('crea_json_catalogo_esercente');
         
//             $xcrud->highlight('validata','=','1','#11d911');