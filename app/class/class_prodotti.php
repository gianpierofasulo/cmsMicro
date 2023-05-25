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
 * Classe astratta prodotti
 * 
 */
abstract class Prodotti  {
  
}

/** 
 * Class Prodotto - gestione prodotti
 * 
 */
class Prodotto extends Prodotti{
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
 * Metodo carica_iva 
 * elenca tutte le valute IVA
 * 
 */ 
public function carica_iva(){
            
                 $this->db->query("SELECT * FROM iva ;");
            
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
 * Metodo cerca_prodotto_per_barcode 
 * ricerca ci un singolo prodotto in base al Barcode
 * @param string $term
 * @param int $id_tipologia_macchina
 */ 
public function cerca_prodotto_per_barcode($term, $id_tipologia_macchina){
            
                 $this->db->query("SELECT * FROM catalogo_generale "
                         . "where codice_a_barre = :term "
                         . "and catalogo_tipologia_id = :id_tipologia_macchina ;");
            
            // Bind dei parametri
             $this->db->bind(':term', $term);
             $this->db->bind(':id_tipologia_macchina', $id_tipologia_macchina);
         
            
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
 * Metodo inserisci_prodotto_catalogo_esercente 
 * inserisce un singolo prodotto nel catalogo esercente
 * @param int $macchina_id
 * @param string $codice_a_barre
 * @param string $descrizione
 * @param string $ristretto_per_minori
 * @param string $vendibile
 * @param string $vendibile_via_web
 * @param int $larghezza
 * @param int $profondita
 * @param int $prezzo
 * @param int $prezzo_scontato
 * @param int $iva_id
 * @param string $immagine
 * @param int $macchina_id_tipologia
 * @param string $titolo
 * @param int $minuti
 */
public function inserisci_prodotto_catalogo_esercente( $macchina_id, $codice_a_barre, $descrizione, $ristretto_per_minori,
                                                       $vendibile, $vendibile_via_web, $larghezza, $profondita, $prezzo,
                                                       $prezzo_scontato, $iva_id, $immagine, $macchina_id_tipologia, $titolo, $minuti ){
                

               $this->db->query("INSERT INTO catalogo_esercente
                            ( id,
                              codice_a_barre,
                              descrizione,
                              immagine,
                              ristretto_per_minori,
                              vendibile, 
                              vendibile_via_web, 
                              larghezza,
                              profondita,
                              prezzo,
                              prezzo_scontato,
                              iva_id,
                              utente_id,
                              macchina_esercente_id,
                              catalogo_tipologia_id,
                              titolo,
                              minuti)
                                        VALUES ( null,
                                                :codice_a_barre,
                                                :descrizione,
                                                :immagine,
                                                :ristretto_per_minori,
                                                :vendibile,
                                                :vendibile_via_web,
                                                :larghezza,
                                                :profondita,
                                                :prezzo,
                                                :prezzo_scontato,
                                                :iva_id,
                                                :utente_id,
                                                :macchina_id,
                                                :macchina_id_tipologia,
                                                :titolo,
                                                :minuti) ");
            
            // Bind dei parametri
            $this->db->bind(':macchina_id', $macchina_id);
            $this->db->bind(':codice_a_barre', $codice_a_barre);
            $this->db->bind(':descrizione', $descrizione);
            $this->db->bind(':ristretto_per_minori', $ristretto_per_minori);
            $this->db->bind(':vendibile', $vendibile);
            $this->db->bind(':vendibile_via_web', $vendibile_via_web);
            $this->db->bind(':larghezza', $larghezza);
            $this->db->bind(':profondita', $profondita);
            $this->db->bind(':prezzo', $prezzo);
            $this->db->bind(':prezzo_scontato', $prezzo_scontato);
            $this->db->bind(':iva_id', $iva_id);
            $this->db->bind(':immagine', $immagine);
            $this->db->bind(':utente_id', $_SESSION['utente_id']);
            $this->db->bind(':macchina_id_tipologia', $macchina_id_tipologia);
            $this->db->bind(':titolo', $titolo);
            $this->db->bind(':minuti', $minuti);
             

            
            try {
                    $this->db->execute();
                    // TUTTO OK
                    return "PRODOTTO INSERITO CORRETTAMENTE";
                 } catch (PDOException $e) {
                    if ($e->errorInfo[1] == 1062) {
                        // duplicate entry
                        return "PRODOTTO GIA' PRESENTE PER LA MACCHINA SELEZIONATA";
                    } else {
                        return $this->db->getError(); 
                    }
                 }
                
                
            

} // END METHOD  ******************************************************


/** 
 * Metodo inserisci_prodotto_catalogo_esercente 
 * inserisce un singolo prodotto nel catalogo esercente
 * @param int $macchina_id
 * @param string $immagine
 * @param string $barcode
 * @param string $titolo
 * @param string $categoria
 * @param string $ristretto_per_minori
 * @param int $vendibile
 * @param int $vendibile_via_web
 * @param int $corrispettivi
 * @param int $larghezza
 * @param int $profondita
 * @param string $descrizione
 * @param int $prezzo
 * @param int $prezzo_scontato
 * @param int $id_tipologia
 */
public function inserisci_prodotto_catalogo_generale( $immagine, $barcode, $titolo, $categoria, $ristretto_per_minori,
                                                    $vendibile, $vendibile_via_web, $corrispettivi, $larghezza, $profondita, $descrizione, $prezzo, $prezzo_scontato, $id_tipologia ){
                

               $this->db->query("INSERT INTO catalogo_generale
                            ( id,
                              codice_a_barre,
                              descrizione,
                              immagine,
                              ristretto_per_minori,
                              vendibile, 
                              vendibile_via_web, 
                              larghezza,
                              profondita,
                              prezzo,
                              prezzo_scontato,
                              iva_id,
                              catalogo_tipologia_id, 
                              titolo,
                              categoria,
                              corrispettivi)
                                        VALUES ( null,
                                                :codice_a_barre,
                                                :descrizione,
                                                :immagine,
                                                :ristretto_per_minori,
                                                :vendibile,
                                                :vendibile_via_web,
                                                :larghezza,
                                                :profondita,
                                                :prezzo,
                                                :prezzo_scontato,
                                                :iva_id,
                                                :catalogo_tipologia_id,
                                                :titolo,
                                                :categoria,
                                                :corrispettivi) ");
            
            // Bind dei parametri
           
            $this->db->bind(':codice_a_barre', $barcode);
            $this->db->bind(':descrizione', $descrizione);
            $this->db->bind(':immagine', $immagine);
            $this->db->bind(':ristretto_per_minori', $ristretto_per_minori);
            $this->db->bind(':vendibile', $vendibile);
            $this->db->bind(':vendibile_via_web', $vendibile_via_web);
            $this->db->bind(':larghezza', $larghezza);
            $this->db->bind(':profondita', $profondita);
            $this->db->bind(':prezzo', $prezzo);
            $this->db->bind(':prezzo_scontato', $prezzo_scontato);
            $this->db->bind(':iva_id', 1);
            
            
            $this->db->bind(':catalogo_tipologia_id', $id_tipologia);
            $this->db->bind(':titolo', $titolo);
            $this->db->bind(':categoria', $categoria);
            $this->db->bind(':corrispettivi', $corrispettivi);

            $this->db->execute();
            try {
                   
                    // TUTTO OK
                    return true;
                 } catch (PDOException $e) {
                    if ($e->errorInfo[1] == 1062) {
                        // duplicate entry
                        return "PRODOTTO GIA' PRESENTE IN CATALOGO";
                    } else {
                        return $this->db->getError(); 
                    }
                 }
                
                
            

} // END METHOD  ******************************************************

/** 
 * Metodo elenco_catalogo_per_esercente 
 * restituisce tutti i prodotti a catalogo dell'esercente ricercato
 * @param int $id_esercente
 */
public function elenco_catalogo_per_esercente($id_esercente){
            
                 $this->db->query("SELECT * FROM catalogo_esercente "
                         . "where utente_id = :id_esercente ;");
            
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

/** 
 * Metodo elenco_categorie_vetrina 
 * restituisce le categorie vetrina digitale della tipologia macchina scelta 
 * @param string $tipologia
 */
public function elenco_categorie_vetrina($tipologia){
            
    $this->db->query("SELECT * FROM macchine_vetrine_digitali_categorie "
            . "where id_tipologia = :tipologia ;");

            // Bind dei parametri

            $this->db->bind(':tipologia', $tipologia);


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
 * Metodo elenco_catalogo_per_macchina 
 * restituisce tutti i prodotti a catalogo della macchina ricercata
 * @param int $id_macchina
 */
public function elenco_catalogo_per_macchina($id_macchina){
            
                 $this->db->query("SELECT id,
                                        codice_a_barre,
                                        descrizione,
                                        immagine,
                                        ristretto_per_minori,
                                        vendibile,
                                        vendibile_via_web,
                                        profondita,
                                        prezzo,
                                        prezzo_scontato,
                                        iva_id,
                                        utente_id,
                                        macchina_esercente_id,
                                        catalogo_tipologia_id,
                                        titolo,
                                        minuti

                                        FROM catalogo_esercente "
                                        . "where macchina_esercente_id = :id_macchina ;");
            
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
 * Metodo elenco_catalogo_per_prodotto 
 * restituisce il prodotto ricercato
 * @param int $id_prodotto
 */
public function elenco_catalogo_per_prodotto($id_prodotto){
            
                 $this->db->query("SELECT * FROM catalogo_esercente "
                         . "where id = :id_prodotto ;");
            
            // Bind dei parametri
            
             $this->db->bind(':id_prodotto', $id_prodotto);
         
            
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
 * Metodo elenco_catalogo_esercente 
 * restituisce tutti i prodotti nella tab catalogo_esercente
 */
public function elenco_catalogo_esercente(){
            
                 $this->db->query("SELECT * FROM catalogo_esercente ");
            
           
            
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
 * Metodo elenco_catalogo_esercente_per_tipo_macchina 
 * restituisce tutti i prodotti del catalogo esercente in base alla tipologia di macchina ricercata
 * @param int $id_tipologia
 */
public function elenco_catalogo_esercente_per_tipo_macchina($id_tipologia){
            
    $this->db->query("SELECT * FROM catalogo_esercente where catalogo_tipologia_id = :id_tipologia");

    $this->db->bind(':id_tipologia', $id_tipologia);

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
 * Metodo elenco_catalogo_generale 
 * restituisce tutti i prodotti del catalogo GENERALE in base alla tipologia di macchina ricercata
 * @param int $id_tipologia_macchina
 */
public function elenco_catalogo_generale($id_tipologia_macchina){
            
            $this->db->query("SELECT * FROM catalogo_generale where catalogo_tipologia_id = :id_tipologia_macchina");

            $this->db->bind(':id_tipologia_macchina', $id_tipologia_macchina);

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
 * Metodo elenco_catalogo_generale 
 * restituisce tutti i prodotti del catalogo GENERALE in base alla tipologia di macchina ricercata
 * @param int $id_tipologia_macchina
 */
public function elenco_vetrina_digitale($id_esercente, $id_macchina, $id_vetrina){
            
    $this->db->query("SELECT macchine_vetrine_digitali.*,catalogo_esercente.immagine, catalogo_esercente.titolo
                                 FROM macchine_vetrine_digitali  , catalogo_esercente
                                where id_esercente = :id_esercente and id_macchina = :id_macchina and macchine_vetrine_digitali.titolo = :id_vetrina
                                AND macchine_vetrine_digitali.id_prodotto = catalogo_esercente.id
                                order by id_slot");

    $this->db->bind(':id_esercente', $id_esercente);
    $this->db->bind(':id_macchina', $id_macchina);
    $this->db->bind(':id_vetrina', $id_vetrina);
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
 * Metodo numero_prodotti_catalogo_generale 
 * restituisce i N. totale dei prodotti del catalogo GENERALE 
 */
public function numero_prodotti_catalogo_generale(){
            
                 $this->db->query("SELECT count(*) as num_prodotti_cat_generale FROM catalogo_generale ");
            
           
            
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
 * Metodo numero_prodotti_catalogo_generale 
 * restituisce i N. totale dei prodotti del catalogo ESERCENTE 
 */
public function numero_prodotti_catalogo_esercente(){
            
                 $this->db->query("SELECT count(*) as num_prodotti_cat_esercente FROM catalogo_esercente ");
            
           
            
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
 * Metodo  ricerca_prodotto_catalogo_generale_per_tipo_macchina
 * restituisce il prodotto del catalogo GENERALE in base alla tipologia di macchina ricercata e barcode
 * @param string $barcode
 * @param int $id_tipologia
 */
public function ricerca_prodotto_catalogo_generale_per_tipo_macchina($barcode, $id_tipologia){
            
    $this->db->query(" SELECT catalogo_generale.*, catalogo_tipologia.descrizione as tipologia 
                       FROM catalogo_generale,catalogo_tipologia
                       WHERE catalogo_generale.codice_a_barre = :codice_a_barre
                       AND catalogo_generale.catalogo_tipologia_id = :id_tipologia
                       AND catalogo_generale.catalogo_tipologia_id = catalogo_tipologia.id ");

                    $this->db->bind(':codice_a_barre', $barcode);
                    $this->db->bind(':id_tipologia', $id_tipologia);

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
 * Metodo public function ricerca_prodotti_catalogo_esercente_per_tipologia_macchina 
 * restituisce il prodotto del catalogo GENERALE in base alla tipologia di macchina ricercata e barcode
 * @param int $id_esercente
 * @param int $id_tipologia
 */
public function ricerca_prodotti_catalogo_esercente_per_tipologia_macchina($id_esercente, $id_tipologia){
            
    $this->db->query(" SELECT catalogo_esercente.*, catalogo_tipologia.descrizione AS tipologia
                        FROM catalogo_esercente, catalogo_tipologia
                        WHERE catalogo_esercente.utente_id = :id_esercente
                        AND catalogo_esercente.catalogo_tipologia_id = :id_tipologia
                        AND catalogo_esercente.catalogo_tipologia_id = catalogo_tipologia.id ");

                    $this->db->bind(':id_esercente', $id_esercente);
                    $this->db->bind(':id_tipologia', $id_tipologia);

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
 * Metodo  ricerca_prodotti_catalogo_esercente_per_matricola_macchina
 * restituisce il prodotto del catalogo ESERCENTE in base all'id esercente e alla matricola macchina
 * @param int $id_esercente
 * @param string $matricola
 */
public function ricerca_prodotti_catalogo_esercente_per_matricola_macchina($id_esercente, $matricola){
            
    $this->db->query(" SELECT catalogo_esercente.*, catalogo_tipologia.descrizione AS tipologia
                            FROM catalogo_esercente, catalogo_tipologia, macchina_esercente
                            WHERE catalogo_esercente.utente_id = :id_esercente
                            AND catalogo_esercente.macchina_esercente_id = macchina_esercente.id
                            AND macchina_esercente.matricola = :matricola
                            AND catalogo_esercente.catalogo_tipologia_id = catalogo_tipologia.id ");

                    $this->db->bind(':id_esercente', $id_esercente);
                    $this->db->bind(':matricola', $matricola);

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
 * Metodo  ricerca_prodotto_catalogo_esercente_per_canale_e_matricola_macchina
 * restituisce la vetrina prodotti del catalogo ESERCENTE in base all'id esercente, n. canale e alla matricola macchina
 * @param int $id_esercente
 * @param int $id_canale
 * @param string $matricola
 */
public function ricerca_prodotto_catalogo_esercente_per_canale_e_matricola_macchina($id_esercente, $id_canale, $matricola){
            
    $this->db->query(" SELECT catalogo_esercente.*,vetrina_macchina.canale

                        FROM catalogo_esercente, vetrina_macchina, macchina_esercente
                        WHERE catalogo_esercente.utente_id = :id_esercente
                        AND catalogo_esercente.id = vetrina_macchina.catalogo_esercente_id
                        AND vetrina_macchina.canale = :id_canale
                        
                        AND macchina_esercente.matricola = :matricola ");

                    $this->db->bind(':id_esercente', $id_esercente);
                    $this->db->bind(':id_canale', $id_canale);
                    $this->db->bind(':matricola', $matricola);

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
 * Metodo  lista_canali_abilitati_per_matricola_macchina
 * restituisce i canali se liberi o occupati  in base all'id esercente, n. canale e alla matricola macchina
 * @param int $id_esercente
 * @param string $matricola
 */
public function lista_canali_abilitati_per_matricola_macchina($id_esercente, $matricola){
            
   /*  RESTITUISCE TUTTI I CANALI ABILITATI DELLA MACCHINA E SE LIBERI O OCCUPATI */

                            $this->db->query("SELECT DISTINCT mec.canale, mec.alias, mec.stato, mec.riga, vm.catalogo_esercente_id AS prodotto_id, c.titolo
                            FROM macchina_esercente m 
                            INNER JOIN macchina_esercente_canali mec ON mec.macchina_esercente_id = m.id
                            LEFT JOIN vetrina_macchina vm 
                            on vm.macchina_esercente_id = mec.macchina_esercente_id AND vm.canale = mec.canale
                            LEFT JOIN catalogo_esercente c 
                            ON c.id = vm.catalogo_esercente_id
                            WHERE m.matricola= :matricola
                            AND m.utente_id = :id_esercente
                            ORDER BY canale  ");


                    $this->db->bind(':id_esercente', $id_esercente);
                   
                    $this->db->bind(':matricola', $matricola);

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
 * Metodo  inserisci_prodotto_catalogo_esercente_da_macchina
 * inserisce un prodotto direttamente dalla vending nel catalogo ESERCENTE
 * @param int $macchina_id
 * @param string $codice_a_barre
 * @param string $descrizione
 * @param string $ristretto_per_minori
 * @param string $vendibile
 * @param string $vendibile_via_web
 * @param int $larghezza
 * @param int $profondita
 * @param int $prezzo
 * @param int $prezzo_scontato
 * @param int $iva_id
 * @param string $immagine
 * @param int $macchina_id_tipologia
 * @param string $titolo
 * @param int $minuti
 * @param int $canale
 */
public function inserisci_prodotto_catalogo_esercente_da_macchina( $macchina_id, $codice_a_barre, $descrizione, $ristretto_per_minori,
                                                       $vendibile, $vendibile_via_web, $larghezza, $profondita, $prezzo,
                                                       $prezzo_scontato, $iva_id, $immagine, $macchina_id_tipologia, $titolo, $minuti,
                                                       $canale ){
                

               $this->db->query("INSERT INTO catalogo_esercente
                            ( id,
                              codice_a_barre,
                              descrizione,
                              immagine,
                              ristretto_per_minori,
                              vendibile, 
                              vendibile_via_web, 
                              larghezza,
                              profondita,
                              prezzo,
                              prezzo_scontato,
                              iva_id,
                              utente_id,
                              macchina_esercente_id,
                              catalogo_tipologia_id,
                              titolo,
                              minuti)
                                        VALUES ( null,
                                                :codice_a_barre,
                                                :descrizione,
                                                :immagine,
                                                :ristretto_per_minori,
                                                :vendibile,
                                                :vendibile_via_web,
                                                :larghezza,
                                                :profondita,
                                                :prezzo,
                                                :prezzo_scontato,
                                                :iva_id,
                                                :utente_id,
                                                :macchina_id,
                                                :macchina_id_tipologia,
                                                :titolo,
                                                :minuti) ");
            
            // Bind dei parametri
            $this->db->bind(':macchina_id', $macchina_id);
            $this->db->bind(':codice_a_barre', $codice_a_barre);
            $this->db->bind(':descrizione', $descrizione);
            $this->db->bind(':ristretto_per_minori', $ristretto_per_minori);
            $this->db->bind(':vendibile', $vendibile);
            $this->db->bind(':vendibile_via_web', $vendibile_via_web);
            $this->db->bind(':larghezza', $larghezza);
            $this->db->bind(':profondita', $profondita);
            $this->db->bind(':prezzo', $prezzo);
            $this->db->bind(':prezzo_scontato', $prezzo_scontato);
            $this->db->bind(':iva_id', $iva_id);
            $this->db->bind(':immagine', $immagine);
            $this->db->bind(':utente_id', $_SESSION['utente_id']);
            $this->db->bind(':macchina_id_tipologia', $macchina_id_tipologia);
            $this->db->bind(':titolo', $titolo);
            $this->db->bind(':minuti', $minuti);
             

            
            try {
                    $this->db->execute();
                    // TUTTO OK INSERISCI IL PRODOTTO NELLA VETRINA

                    $id_prodotto_inserito = $this->db->lastInsertId();

                    $this->db->query("INSERT INTO vetrina_macchina
                            ( id,
                              catalogo_esercente_id,
                              macchina_esercente_id,
                              utente_id,
                              canale)
                                        VALUES ( null,
                                                $id_prodotto_inserito,
                                                $macchina_id,
                                                :utente_id,
                                                :canale) ");
                                $this->db->bind(':canale', $canale);
                                $this->db->bind(':utente_id', $_SESSION['utente_id']);
                                try {

                                    $this->db->execute();
                                    return true;

                                } catch (PDOException $e) {
                                    return $this->db->getError(); 
                                }

                   
                 } catch (PDOException $e) {
                    if ($e->errorInfo[1] == 1062) {
                        // duplicate entry
                        return "PRODOTTO GIA' PRESENTE PER LA MACCHINA SELEZIONATA";
                    } else {
                        return $this->db->getError(); 
                    }
                 }
                
                
            

} // END METHOD  ******************************************************

/** 
 * Metodo  aggiorna_prodotto_catalogo_esercente_da_macchina
 * aggiorna un prodotto direttamente dalla vending nel catalogo ESERCENTE
 * @param int $utente_id
 * @param int $id_prodotto
 * @param int $macchina_id
 * @param int $canale
 * @param string $descrizione
 * @param int $vendibile
 * @param int $vendibile_via_web
 * @param int $larghezza
 * @param int $profondita
 * @param int $prezzo
 * @param string $titolo
 */

public function aggiorna_prodotto_catalogo_esercente_da_macchina(   $utente_id, $id_prodotto,  $macchina_id, $canale, 
                                                                    $descrizione, $vendibile,
                                                                    $vendibile_via_web, $larghezza, $profondita, $prezzo,
                                                                    $titolo ) 
                                                       {
                

               $this->db->query("UPDATE catalogo_esercente
                                SET     descrizione = :descrizione,
                                        vendibile = :vendibile, 
                                        vendibile_via_web = :vendibile_via_web, 
                                        larghezza = :larghezza,
                                        profondita = :profondita,
                                        prezzo = :prezzo,
                                        titolo = :titolo
                                        
                                        WHERE catalogo_esercente.id = :id_prodotto ");
            
            // Bind dei parametri
            
            $this->db->bind(':descrizione', $descrizione);
            $this->db->bind(':id_prodotto', $id_prodotto);         
            $this->db->bind(':vendibile', $vendibile);
            $this->db->bind(':vendibile_via_web', $vendibile_via_web);
            $this->db->bind(':larghezza', $larghezza);
            $this->db->bind(':profondita', $profondita);
            $this->db->bind(':prezzo', $prezzo);          
            $this->db->bind(':titolo', $titolo);
            $this->db->execute();
          //  $trovato = $this->db->rowCount();

            try { 
                    // DEVO FARE QUERY PER VEDERE SE QUEL CANALE GIA' ESISTE NELLA VETRINA PER QUEL ESERCENTE E MAcchinA
                    // ALTRIMENTI DEVO FARE UN AINSERT
                    $this->db->query("SELECT vetrina_macchina.id
                                        FROM vetrina_macchina
                                        WHERE vetrina_macchina.macchina_esercente_id = :macchina_id
                                        AND vetrina_macchina.utente_id = :utente_id
                                        AND vetrina_macchina.canale = :canale ");
                     $this->db->bind(':canale', $canale);
                     $this->db->bind(':utente_id', $utente_id);                   
                     $this->db->bind(':macchina_id', $macchina_id);

                     $rows = $this->db->single();

                     if ( $rows['id'] > 0 ) { 
                        // UPDATE
                        $this->db->query("UPDATE vetrina_macchina

                                                SET vetrina_macchina.catalogo_esercente_id = :id_prodotto_vetrina,
                                                vetrina_macchina.canale = :canale
                                                
                                                WHERE vetrina_macchina.id = :id_record");

                        $this->db->bind(':canale', $canale);
                        $this->db->bind(':id_prodotto_vetrina', $id_prodotto);                  
                        $this->db->bind(':id_record', $rows['id']);
                        $this->db->execute();

                     } else { 
                        // INSERT
                         // TUTTO OK INSERISCI IL PRODOTTO NELLA VETRINA
                            $this->db->query("INSERT INTO vetrina_macchina
                                                        ( id,
                                                        catalogo_esercente_id,
                                                        macchina_esercente_id,
                                                        utente_id,
                                                        canale)
                                                                    VALUES ( null,
                                                                            :id_prodotto_vetrina,
                                                                            :macchina_id,
                                                                            :utente_id,
                                                                            :canale) ");
                                $this->db->bind(':canale', $canale);
                                $this->db->bind(':utente_id', $utente_id);
                                $this->db->bind(':id_prodotto_vetrina', $id_prodotto);
                                $this->db->bind(':macchina_id', $macchina_id);
                                try {

                                    $this->db->execute();
                                    return true;

                                } catch (PDOException $e) {
                                    return $this->db->getError(); 
                                }

                            }

                   
                   
                   
                 } catch (PDOException $e) {
                    if ($e->errorInfo[1] == 1062) {
                        // duplicate entry
                        return "PRODOTTO GIA' PRESENTE PER LA MACCHINA SELEZIONATA";
                    } else {
                        return $this->db->getError(); 
                    }
                 }
                
                
           

} // END METHOD  ******************************************************

/** 
 * Metodo  associa_prodotto_multicanale_da_macchina
 * veede il prodotto da associare si più canali per poi avere i dati a disposizione per la insert vera e propria
 * @param string $matricola_macchina
 * @param int $id_prodotto_da_associare
 * @param int $canale
 * @param int $numero_di_canali 
 */
public function associa_prodotto_multicanale_da_macchina( $matricola_macchina, $id_prodotto_da_associare, $canale, $larghezza ){
    
    // Recupero dalla mstricola macchina, ID_MACCHINA e ID_UTENTE CHE mi servono poi per l'isert dell'associazione
    $this->db->query(" SELECT utente_id, id as id_macchina
                        FROM macchina_esercente
                        WHERE macchina_esercente.matricola = :matricola_macchina 
                        ");
    $this->db->bind(':matricola_macchina', $matricola_macchina); 
    $this->db->execute();
    $dati_di_ritorno = $this->db->single();

    if ($dati_di_ritorno) {
        $macchina_id = $dati_di_ritorno['id_macchina'];
        $id_utente  = $dati_di_ritorno['utente_id'];

        $related = 0;
        // devo fare la insert per quanti sono i canali da occupare partendo dal primo canale
        $primo_canale = $canale;
        for ( $contaCanali =1; $contaCanali <= $larghezza; $contaCanali++ ) {

        // calcolo del campo related usato nei multicanale, che, nel primo canale deve essere 0 mentre per gli altri canali
        // deve avere come valore il canale del primo prodotto
        if ( $contaCanali == 1) {
            // e' il primo canale
            $related = 0;
            $assegna_larghezza = $larghezza;
        } else {
            $related = $primo_canale; // relazioneto al canale del primo insert
            $assegna_larghezza = 0;
        }
        $group = "B";
        $type = "BOARD";

        // TO DO, va preso il GROUP E IL TYPE per ora messi fissi perchè vanno presi dalla conf della macchina
        // e ad oggi ancora non è inviato il JSON dalla macchina verso il CLOUD

        $this->db->query("INSERT INTO vetrina_macchina
        ( id,
            catalogo_esercente_id,
            macchina_esercente_id,
            utente_id,
            canale,
            gruppo,
            larghezza,
            related,
            tipo)
                    VALUES ( null,
                            :id_prodotto_da_associare,
                            :macchina_id,
                            :utente_id,
                            :canale,
                            :group,
                            :assegna_larghezza,
                            :related,
                            :tipo) ");

            $this->db->bind(':macchina_id', $macchina_id);                
            $this->db->bind(':canale', $canale);
            $this->db->bind(':utente_id', $id_utente);
            $this->db->bind(':id_prodotto_da_associare', $id_prodotto_da_associare);
            $this->db->bind(':group', $group);
            $this->db->bind(':related', $related);
            $this->db->bind(':tipo', $type);
            $this->db->bind(':assegna_larghezza', $assegna_larghezza);
            $this->db->execute();
            try {
               
                $canale++;
                

             } catch (PDOException $e) {
                if ($e->errorInfo[1] == 1062) {
                    // duplicate entry
                    return "PRODOTTO GIA' PRESENTE PER LA MACCHINA SELEZIONATA";
                } else {
                    return $this->db->getError(); 
                }
             }
        }
       
        return true;


    } else {
        return $this->db->getError(); 
    }


} // END METHOD  ******************************************************

/** 
 * Metodo  associa_prodotto_canale_da_macchina
 * veede il prodotto da associare per poi avere i dati a disposizione per la insert vera e propria
 * @param string $matricola_macchina
 * @param int $id_prodotto_da_associare
 * @param int $canale
 * 
 */
public function associa_prodotto_canale_da_macchina( $matricola_macchina, $id_prodotto_da_associare, $canale ){
    
            // Recupero dalla mstricola macchina, ID_MACCHINA e ID_UTENTE CHE mi servono poi per l'isert dell'associazione
            $this->db->query(" SELECT utente_id, id as id_macchina
                                FROM macchina_esercente
                                WHERE macchina_esercente.matricola = :matricola_macchina 
                                ");
            $this->db->bind(':matricola_macchina', $matricola_macchina); 
            $this->db->execute();
            $dati_di_ritorno = $this->db->single();

            if ($dati_di_ritorno) {
                $macchina_id = $dati_di_ritorno['id_macchina'];
                $id_utente  = $dati_di_ritorno['utente_id'];
                
                $this->db->query("INSERT INTO vetrina_macchina
                ( id,
                    catalogo_esercente_id,
                    macchina_esercente_id,
                    utente_id,
                    canale)
                            VALUES ( null,
                                    :id_prodotto_da_associare,
                                    :macchina_id,
                                    :utente_id,
                                    :canale) ");
    
                    $this->db->bind(':macchina_id', $macchina_id);                
                    $this->db->bind(':canale', $canale);
                    $this->db->bind(':utente_id', $id_utente);
                    $this->db->bind(':id_prodotto_da_associare', $id_prodotto_da_associare);
                
               
                try {
                        $this->db->execute();
                       
    
                     } catch (PDOException $e) {
                        if ($e->errorInfo[1] == 1062) {
                            // duplicate entry
                            return "PRODOTTO GIA' PRESENTE PER LA MACCHINA SELEZIONATA";
                        } else {
                            return $this->db->getError(); 
                        }
                     }
                     return true;

            } else {
                return $this->db->getError(); 
            }


} // END METHOD  ******************************************************

public function crea_json_canali_da_macchina( $matricola_macchina, $esercente_id ){
    
   
    $this->db->query(" SELECT DISTINCT mec.canale, mec.alias, mec.stato, mec.riga, vm.catalogo_esercente_id AS prodotto_id, vm.gruppo, vm.larghezza, vm.related, vm.tipo
                            FROM macchina_esercente m 
                            INNER JOIN macchina_esercente_canali mec ON mec.macchina_esercente_id = m.id
                            LEFT JOIN vetrina_macchina vm 
                            on vm.macchina_esercente_id = mec.macchina_esercente_id AND vm.canale = mec.canale
                            LEFT JOIN catalogo_esercente c 
                            ON c.id = vm.catalogo_esercente_id
                            WHERE m.matricola= :matricola_macchina
                            AND m.utente_id = :esercente_id
                            ORDER BY canale 
                        ");
    $this->db->bind(':matricola_macchina', $matricola_macchina); 
    $this->db->bind(':esercente_id', $esercente_id); 
    
    $this->db->execute();

    try {
       
        return $this->db->resultset();;

     } catch (PDOException $e) {
       
            return $this->db->getError(); 
       
     }
   
} // END METHOD  ******************************************************

/** 
 * Metodo  ricerca_prod_cat_eser_per_barcode
 * ricerca il prodotto sul catalogo esercente in base al barcode
 * @param int $id_esercente
 * @param string $barcode
 */
public function ricerca_prod_cat_eser_per_barcode($id_esercente, $barcode){
            
    $this->db->query(" SELECT catalogo_esercente.*
                        FROM catalogo_esercente
                        WHERE catalogo_esercente.utente_id = :id_esercente
                        AND catalogo_esercente.codice_a_barre = :barcode ");

                    $this->db->bind(':id_esercente', $id_esercente);
                    $this->db->bind(':barcode', $barcode);
                   

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
 * Metodo  cancella_prod_vetrina_digitale
 * cancella il prodotto dalla vetrina digitale
 * @param int $id_record
 */
public function cancella_prod_vetrina_digitale($id_record){
            
   if ($id_record )  {
    $this->db->query(" DELETE FROM macchine_vetrine_digitali
                        WHERE id = :id_record");

                    $this->db->bind(':id_record', $id_record);
                  

            if($this->db->execute())
            {
                return ['risposta'=>'ok'];
            } else {
                    // Handle errors
                return $this->db->getError(); 
            }
        }

} // END METHOD ******************************************************


/** 
 * Metodo  modifica_prod_vetrina_digitale
 * modifica il prodotto dalla vetrina digitale
 * @param int $id_record
 * @param int $id_prodotto_selezionato
 */
public function modifica_prod_vetrina_digitale($id_record, $id_prodotto_selezionato){
            
    if ( $id_record )  {
     $this->db->query(" UPDATE  macchine_vetrine_digitali
                         set id_prodotto = :id_prodotto_selezionato
                         WHERE id = :id_record");
 
                     $this->db->bind(':id_record', $id_record);
                     $this->db->bind(':id_prodotto_selezionato', $id_prodotto_selezionato);
                   
 
             if($this->db->execute())
             {
                 return ['risposta'=>'ok'];
             } else {
                     // Handle errors
                 return $this->db->getError(); 
             }
         }
 
 } // END METHOD ******************************************************

 /** 
 * Metodo  aggiungi_prod_vetrina_digitale
 * Aggiunge il prodotto dalla vetrina digitale
 * @param int $id_record
 * @param int $id_prodotto_selezionato
 */
public function aggiungi_prod_vetrina_digitale( $id_slot, $id_prodotto_selezionato, $id_esercente, $id_macchina, $layout, $id_vetrina ){
            
    if ( $id_prodotto_selezionato )  {
                            $this->db->query("INSERT INTO macchine_vetrine_digitali
                                                        ( id,
                                                        id_esercente,
                                                        id_macchina,
                                                        abilitato,
                                                        titolo,
                                                        layout,
                                                        id_slot,
                                                        id_prodotto )
                                                VALUES ( null,
                                                        :id_esercente,
                                                        :id_macchina,
                                                        1,
                                                        :id_vetrina,
                                                        :layout,
                                                        :id_slot,
                                                        :id_prodotto_selezionato) ");
 
                     $this->db->bind(':id_slot', $id_slot);
                     $this->db->bind(':id_prodotto_selezionato', $id_prodotto_selezionato);
                     $this->db->bind(':id_esercente', $id_esercente);
                     $this->db->bind(':id_macchina', $id_macchina);
                     $this->db->bind(':layout', $layout);
                     $this->db->bind(':id_vetrina', $id_vetrina);
                   
 
             if($this->db->execute())
             {
                 return ['risposta'=>'ok'];
             } else {
                     // Handle errors
                 return $this->db->getError(); 
             }
         }
 
 } // END METHOD ******************************************************




} // END CLASS ******************************************    