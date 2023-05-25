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

include  'class_connection.php' ;

/**
 * Classe Astratta
 */
abstract class GestioneLogOperazioni  {
  
}

/** 
 * Class LogOperazioni - gestione del log
 * 
 */
class LogOperazioni extends GestioneLogOperazioni{
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
 * Metodo start_operazione
 * inizia una nuova operazione scrivendo nel log
 * parametri $id_utente, $ip_client, $endpoint_richiamato, $matricola, $json_file 
 * @param int $id_utente
 * @param string $ip_client
 * @param string $endpoint_richiamato
 * @param string $matricola
 * @param string $json_file
 */
public function start_operazione( $id_utente, $ip_client, $endpoint_richiamato, $matricola, $json_file ) {


                            $this->db->query("INSERT INTO log_operazioni
                                                ( id, id_utente, ip_client, endpoint_richiamato, matricola,  stato )
                                                    VALUES ( null,
                                                            :utente_id,
                                                            :ip_client,
                                                            :endpoint_richiamato,
                                                            :matricola,
                                                            0 ) ");

                        // Bind dei parametri
                        $this->db->bind(':utente_id', $id_utente );
                        $this->db->bind(':ip_client', $ip_client);
                        $this->db->bind(':endpoint_richiamato', $endpoint_richiamato);
                        $this->db->bind(':matricola', $matricola);

                        if( $this->db->execute())
                        {

                            return true;

                        } else {
                            // Handle errors
                            return $this->db->getError(); 
                        }

} // END METHOD start_operazione ******************************************************

/** 
 * Metodo leggi_json
 * prende i dati JSON inviati dalla macchina con l'oggetto operazione
 * 
 */
public function leggi_json(){
            
    $this->db->query("SELECT json_file FROM log_operazioni ;");

            // Bind dei parametri
            // $this->db->bind(':id', $id_utente);


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
     

    
} // END CLASS ******************************************    