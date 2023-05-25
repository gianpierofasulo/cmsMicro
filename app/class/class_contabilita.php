<?php
/**
     * CMS PER CLIENTE MICROHARD
     *
     * CMS per la gestione lato Web delle Vending Machine
     *
     * @package      CMS MICROHARD
     * @subpackage   Some Subpackage
     * @category     CMS per MICROHARD
     * @author       XIMPLIA
     */

require_once  'class_connection.php' ;

/** 
 * Classe astratta contabilità
 * 
 */
abstract class Contabile  {
  
}

/** 
 * Class Prodotto - gestione prodotti
 * 
 */
class Contabilita extends Contabile{
    /**
     * @param string $db 
     */
    private $db;

/** 
 * Costruttore instanza per l'oggetto del Database
 * @return void
 */    
public function __construct(){
		// Instantiate new Database object
		$this->db = new Database;
  }              
     


/** 
 * Metodo carica_contabilita 
 * visualizza lo stato della contabilità di una macchina
 * @param int $id_macchina
 * @param int $id_esercente
 */ 
public function carica_contabilita($id_esercente = null, $id_macchina){
            
            $this->db->query("SELECT * FROM contabilita "
                         . "where id_macchina = :id_macchina ; " );
                         
            
            // Bind dei parametri
             $this->db->bind(':id_macchina', $id_macchina);
        //     $this->db->bind(':id_esercente', $id_esercente);
         
            
            if($this->db->execute())
		{
			if($this->db->rowCount() > 0)
			{
                            $rows = $this->db->single();
                            return  $rows;
				
			}
		} else {
                     // Handle errors
                    return $this->db->getError(); 
                }
       
} // END METHOD ******************************************************





/** 
 * Metodo carica_contabilita_motori 
 * visualizza lo stato della contabilità motori di una macchina
 * @param int $id_macchina
 * @param int $id_esercente
 */
public function carica_contabilita_motori($id_esercente = null, $id_macchina){
            
                    $this->db->query("SELECT * FROM contabilita_motori "
                        . "where id_macchina = :id_macchina order by alias;" );
                        

                    // Bind dei parametri
                    $this->db->bind(':id_macchina', $id_macchina);
                 //   $this->db->bind(':id_esercente', $id_esercente);

            if($this->db->execute())
            {
            if($this->db->rowCount() > 0)
            {
                        $rows = $this->db->resultset();
                        return  $rows;
            
            }
            } else {
                    // Handle errors
                return $this->db->getError(); 
            }

} // END METHOD ******************************************************


/** 
 * Metodo azzera_contabilita 
 * azzera valori contabilità di una macchina
 * @param int $id_macchina
 * @param int $id_esercente
 */ 
public function azzera_contabilita($id_esercente, $id_macchina){
    // serve per update data azzeramento    
    $data_del_giorno = date("Y-m-d");  

    $this->db->query("UPDATE contabilita set azzeramento = '$data_del_giorno',
                                incasso = 0,
                                incasso_monete = 0,
                                incasso_banconote = 0,
                                incasso_pos = 0,
                                incasso_cashless = 0,
                                incasso_scontrino = 0,
                                resto_scontrino = 0,
                                resto_monete = 0,
                                resto_totale = 0,
                                totale_venduto = 0  "
                                . "where id_esercente = :id_esercente "
                                . "and id_macchina = :id_macchina ;"); 
                    // Bind dei parametri
                    $this->db->bind(':id_macchina', $id_macchina);
                    $this->db->bind(':id_esercente', $id_esercente);


                    if ( $this->db->execute() )
                    {
            
                                    return  true;
                          
                    } else {
                            // Handle errors
                            return $this->db->getError(); 
                        }

} // END METHOD ******************************************************

/** 
 * Metodo azzera_contabilita 
 * azzera valori contabilità di una macchina
 * @param int $id_macchina
 * @param int $id_esercente
 */ 
public function azzera_contabilita_motori($id_esercente, $id_macchina){
    
    $this->db->query("DELETE FROM contabilita_motori "
                                . "where id_esercente = :id_esercente "
                                . "and id_macchina = :id_macchina ;"); 
                    // Bind dei parametri
                    $this->db->bind(':id_macchina', $id_macchina);
                    $this->db->bind(':id_esercente', $id_esercente);


                    if ( $this->db->execute() )
                    {
            
                                    return  true;
                          
                    } else {
                            // Handle errors
                            return $this->db->getError(); 
                        }

} // END METHOD ******************************************************

} // END CLASS ******************************************    