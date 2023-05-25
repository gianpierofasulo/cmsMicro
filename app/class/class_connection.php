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

// Define database configuration
	/* define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "microhard"); */
// SERVER XIMPLIA
	define("DB_HOST", "10.198.110.18");
	define("DB_USER", "user_microhard");
	define("DB_PASS", "%7Hz5rM8?Y37a895O5%k");
	define("DB_NAME", "db_microhard");

/** 
 * Class Database - gestione connessione al database
 * 
 * @param string $host With a *description* 
 * 								IP dell'host del database
 * @return void
 */	

	class Database{
		/** 
		 * IP dell'host del DB
		 */	
		private $host      = DB_HOST;
		/** 
		 * Nome utente di connessione al DB
		 */	
		private $user      = DB_USER;
		/** 
		 * Password di connessione al DB
		 */
		private $pass      = DB_PASS;
		/** 
		 * Nome del DB
		 */
		private $dbname    = DB_NAME;
		/** 
		 * Istanza del DB
		 */
		private $dbh;
		private $error;
		private $stmt;

		/**
		 * Connessione al database in PDO
		 * 
		 */
	 
		public function __construct(){
			// Set DSN
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
			// Set options
			$options = array(
				PDO::ATTR_PERSISTENT    => true,
				PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
			);
			// Create a new PDO instanace
			try{
				$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
			}
			// Catch any errors
			catch(PDOException $e){
				$this->error = $e->getMessage();
			}
		}

		/**
		 * Esegue una query sul database
		 * @param $query - tipo stringa
		 * 
		 */
		public function query($query){
			$this->stmt = $this->dbh->prepare($query);
		}

		/**
		 * Esegue il bind sui parametri passati alla query e ne stabilisce il tipo
		 * @param $param - nome del parametro da passare alla Query - tipo stringa
		 * @param $value - valore passato al parametro
 		 * @param $type - tipo di parametro, cioè se int, null, string etc.
		 */
		public function bind($param, $value, $type = null){
			if (is_null($type)) {
				switch (true) {
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;
					default:
						$type = PDO::PARAM_STR;
				}
			}
			$this->stmt->bindValue($param, $value, $type);
		}
		/**
		 * Esegue la Query sul DB
		 */
		public function execute(){
			return $this->stmt->execute();
		}    
		/**
		 * Restituisce un resultset
		 */
		public function resultset(){
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		/**
		 * Restituisce un singolo record
		 */
		public function single(){
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_ASSOC);
		}
		/**
		 * Restituisce il numero delle righe interessate alla Query
		 */
		public function rowCount(){
			return $this->stmt->rowCount();
		}
		/**
		 * Restituisce l'id del record appena inserito
		 */
		public function lastInsertId(){
			return $this->dbh->lastInsertId();
		}
		/**
		 * Start transazione
		 */
		public function beginTransaction(){
			return $this->dbh->beginTransaction();
		}
		/**
		 * END transazione
		 */
		public function endTransaction(){
			return $this->dbh->commit();
		}
		/**
		 * Cancella transazione
		 */
		public function cancelTransaction(){
			return $this->dbh->rollBack();
		}
		/**
		 * Debug dei parametri
		 */

		public function debugDumpParams(){
			return $this->stmt->debugDumpParams();
		}
        /**
		 * Ritorna l'errore in formato stringa
		 */        
		public function getError(){
			return $this->stmt->errorInfo();
		}
        /**
		 * Ritorna il codice dell'errore
		 */        
		public function getErrorCode(){
			return $this->stmt->errorInfo[1];
		}
		/**
		 * Chiude la connessione
		 */
		public function close(){
		  $this->dbh = null;
		}
	}
