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
 * Classe Astratta
 */

abstract class Utenti  {
  
}
/** 
 * Class Utente - gestione operazioni su utenti
 * 
 */

class Utente extends Utenti{
    /**
     * @param string $db 
     */
    private $db;
    
public function __construct(){
		/** 
         * Costruttore instanza per l'oggetto del Database
         * @return void
         */
		$this->db = new Database;
  }     

/** 
 * Metodo registra_sessione
 * inizia una nuova sessione impostando le variabili di sessione
 * @param int $utente_id
 * @param string $utente_nome
 * @param string $utente_cognome
 * @param string $utente_email
 * @param string $utente_data_scadenza
 * @param string $utente_attivo
 * @param string $utente_ruolo
 * @param int $utente_id_ruolo
 */
     
public function registra_sessione( $utente_id, $utente_nome, $utente_cognome, $utente_email,
        $utente_data_scadenza, $utente_attivo, $utente_ruolo, $utente_id_ruolo){
            
                    
                    if(session_start() ) {
                        
                        $_SESSION['utente_id'] = $utente_id;
                        $_SESSION['utente_nome'] = $utente_nome;
                        $_SESSION['utente_cognome'] = $utente_cognome;
                        $_SESSION['utente_email'] = $utente_email;
                        $_SESSION['utente_data_scadenza'] = $utente_data_scadenza;
                        $_SESSION['utente_attivo'] = $utente_attivo;
                        $_SESSION['utente_ruolo'] = $utente_ruolo;
                        $_SESSION['utente_id_ruolo'] = $utente_id_ruolo;

                        return true;
                    }
                    return false;
       
} // END METHOD ******************************************************

/** 
 * Metodo distruggi_sessione
 * svuota la sessione
 * @param void
 */
public function distruggi_sessione(){
            
                 session_destroy();
       
} // END METHOD ******************************************************


/** 
 * Metodo vedi_profilo
 * ritorna il profilo utente
 * @param int $id_utente
 */
public function vedi_profilo($id_utente){
            
                 $this->db->query("SELECT utente.*, ruolo.descrizione FROM utente
                                INNER JOIN ruolo ON utente.ruolo_id=ruolo.id
                                where utente.id = :id
                                 AND attivo = 1
                                 AND data_scadenza > now();");
            
            // Bind dei parametri
            $this->db->bind(':id', $id_utente);
         
            
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
 * Metodo modifica_profilo
 * permette la modifica di un profilo utente
 * @param int $id_utente
 * @param string $utente_nome
 * @param string $utente_cognome
 * @param string $utente_email
 * @param string $utente_password
 */
public function modifica_profilo($id_utente, $utente_nome, $utente_cognome, $utente_email, $utente_password = ''){
            
                if ( $utente_password == '' ) {
                        $this->db->query("UPDATE utente SET
                                        nome = :utente_nome,
                                        cognome = :utente_cognome,
                                        email = :utente_email
                                        WHERE id = :id;");
                 } else {
                     $this->db->query("UPDATE utente SET
                                        nome = :utente_nome,
                                        cognome = :utente_cognome,
                                        email = :utente_email,
                                        password = :utente_password
                                        WHERE id = :id;");
                      $this->db->bind(':utente_password', $utente_password);
                 }
            // Bind dei parametri
            $this->db->bind(':id', $id_utente);
            $this->db->bind(':utente_nome', $utente_nome);
            $this->db->bind(':utente_cognome', $utente_cognome);
            $this->db->bind(':utente_email', $utente_email);
           
         
            
            if($this->db->execute())
		{
		   return true;
		} else {
                     // Handle errors
                    return $this->db->getError(); 
                }
       
} // END METHOD ******************************************************

/** 
 * Metodo conta_utenti
 * numero di utenti presenti (serve per statistiche dashboard)
 */
public function conta_utenti(){
            
                 $this->db->query("SELECT COUNT(*) as n_utenti FROM utente;");
                                
            
            // Bind dei parametri
            // $this->db->bind(':id', $id_utente);
         
            
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
 * Metodo statistiche_login
 * statistiche di accesso di utenti (serve per statistiche dashboard)
 */
public function statistiche_login(){
            
                 $this->db->query("SELECT CONCAT( utente.cognome,' ',utente.nome ) as utente, utente.data_scadenza,
                            COUNT(utente_login.id) AS numero_login,
                            MIN( date(utente_login.data_accesso) ) AS primo_login, 
                            MAX( date(utente_login.data_accesso) ) AS ultimo_login,                           
                            DATEDIFF( NOW() , MAX( utente_login.data_accesso )  ) AS giorni_da_utlimo_login
                            FROM utente, utente_login
                            WHERE utente.id = utente_login.utente_id
                            GROUP BY utente_login.utente_id
                            ORDER BY MAX( date(utente_login.data_accesso) ) desc 
                            LIMIT 6 ;");
            
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

/** 
 * Metodo elenco_media
 * ritorna la liste dei media di un esercente
 * @param int $id_esercente
 */
public function elenco_media($id_esercente){
            
    $this->db->query("SELECT *
                   from media
                   where utente.id = :id_esercente;");

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