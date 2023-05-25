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

$utente =$_SESSION['utente_id'];

/**  
 * Classe Astratta
 */
abstract class Macchine  {
  
}

/**
 * CLASSE Macchina per Gestione Vending
 */

class Macchina extends Macchine{
    /**
     * @param string $db 
     */
    private $db;
    /** 
     * Costruttore instanza per l'oggetto del Database
     * 
     */     
public function __construct(){
		// Instantiate new Database object
		$this->db = new Database;
  }              
     

/** 
 * Metodo vedi macchine
 * elenca tutte le vending abbinate ad un esercente
 * parametri $utente
 * @param int $utente
 * 
 */  
public function vedi_macchine($utente){
            
                 $this->db->query("SELECT id, matricola, tipologia_id  FROM macchina_esercente where utente_id = :esercente;");
            
            // Bind dei parametri
             $this->db->bind(':esercente', $utente);
         
            
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
 * Metodo vedi macchine
 * elenca tutte le vending abbinate ad un esercente
 * parametri $utente
 * @param int $utente
 * 
 */  
public function vedi_macchine_admin(){
            
    $this->db->query("SELECT id, matricola, tipologia_id  FROM macchina_esercente;");

// Bind dei parametri
// $this->db->bind(':esercente', $utente);


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
 * Metodo vedi_macchine_vetrine_digitali
 * elenca tutte le macchina che abbiano vetrine da configurare
 * parametri $id_esercente
 * @param int $id_esercente
 * 
 */  
public function vedi_macchine_vetrine_digitali($id_esercente){
            
    $this->db->query("SELECT CONCAT(macchina_esercente.matricola,' ',macchine_vetrine_digitali.titolo) AS macchina,
                                            macchina_esercente.id , macchine_vetrine_digitali.titolo, catalogo_tipologia.descrizione
                                        from macchina_esercente, macchine_vetrine_digitali, catalogo_tipologia
                                            WHERE macchine_vetrine_digitali.id_esercente = :esercente
                                            and macchina_esercente.utente_id = macchine_vetrine_digitali.id_esercente
                                            AND macchine_vetrine_digitali.id_macchina = macchina_esercente.id
                                            AND macchina_esercente.tipologia_id = catalogo_tipologia.id
                                            group by macchine_vetrine_digitali.titolo;");

                        // Bind dei parametri
                        $this->db->bind(':esercente', $id_esercente);


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
 * Metodo vedi macchine
 * elenca tutte le vending abbinate ad un esercente
 * parametri $utente
 * @param int $utente
 * 
 */  
public function vedi_tipologie(){
            
    $this->db->query("SELECT *  FROM catalogo_tipologia order by descrizione");


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
 * Metodo vedi macchine canali liberi
 * restituisce i canali configurati sulla vending ma, non utilizzati da prodotti
 * @param int $id_macchina
 * 
 */  
public function vedi_macchine_canali_liberi($id_macchina){
            
    $this->db->query(" SELECT *
                        FROM macchina_esercente_canali
                        WHERE stato = 'Disabilitato'
                        AND macchina_esercente_canali.macchina_esercente_id = :id_macchina;");

// Bind dei parametri
$this->db->bind(':id_macchina', $id_macchina);


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
 * Metodo numero_totale_macchine
 * restituisce il numero totale delle vending 
 * 
 */  
public function numero_totale_macchine(){
            
                 $this->db->query("SELECT count(*) as numero_macchine FROM macchina_esercente");
            
           
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
 * Metodo lista_media
 * restituisce l'elenco di tutti i media (video e foto) di un esercente
 * @param int $id_esercente
 * 
 */ 
public function lista_media($id_esercente){
            
    $this->db->query(" SELECT *
                        FROM media
                        WHERE id_esercente = :id_esercente;");

        // Bind dei parametri
        $this->db->bind(':id_esercente', $id_esercente);


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