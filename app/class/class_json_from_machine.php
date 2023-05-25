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

use Zend\Config\Reader\Json;

require_once  'class_connection.php' ;

/** 
 * Classe astratta json to machine
 * 
 */
abstract class JsonFromMachines  {
  
}

/** 
 * Class JsonFromMachine - gestione caricamento JSON provenienti dalle vending
 * 
 */
class JsonFromMachine extends JsonFromMachines{
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
 * Metodo carica_json_config 
 * inserisce i dati del Json provenienti dalla macchina
 * @param int $id_esercente
 * @param int $id_macchina
 */ 
public function carica_json_config($servizio, $JsonDATA = null, $id_utente, $id_macchina) {
    
    if ( !$JsonDATA ) {
        return false;
        die('NO JSON DATA');
    }

    $decoded_json = json_decode($JsonDATA, false);

    if ($servizio == 'config') { 

    // CAMPI JSON
            $pay_before_selection = $decoded_json->behavior[0]->pay_before_selection;
            $limitazioni_eta = $decoded_json->behavior[0]->limitazioni_eta;
            $vetrina_digitale = $decoded_json->behavior[0]->vetrina_digitale;
            $continua_vendita = $decoded_json->behavior[0]->continua_vendita;
            $gruppo_tastierino = $decoded_json->behavior[0]->gruppo_tastierino;
            
            $default_lang = $decoded_json->generali[0]->default_lang;
            $id_macchina = $decoded_json->generali[0]->id_macchina;
            $id_esercente = $decoded_json->generali[0]->id_esercente;
            $matricola = $decoded_json->generali[0]->matricola;
            $resto_max = $decoded_json->generali[0]->resto_max;
            $resto_abilitato = $decoded_json->generali[0]->resto_abilitato;
            $timer_vendita = $decoded_json->generali[0]->timer_vendita;
            $timer_manager = $decoded_json->generali[0]->timer_manager;
            $timer_pagina_principale = $decoded_json->generali[0]->timer_pagina_principale;
            $validita_ticket_settimane = $decoded_json->generali[0]->validita_ticket_settimane;
            $volume_interfaccia = $decoded_json->generali[0]->volume_interfaccia;
            
          

            $nome_venditore = $decoded_json->info_venditore[0]->nome_venditore;
            $indirizzo_venditore = $decoded_json->info_venditore[0]->indirizzo_venditore;
            $localita_venditore = $decoded_json->info_venditore[0]->localita_venditore;
            $email_venditore = $decoded_json->info_venditore[0]->email_venditore;
            $telefono_venditore = $decoded_json->info_venditore[0]->telefono_venditore;
            $fax_venditore = $decoded_json->info_venditore[0]->fax_venditore;
            $orario_lun = $decoded_json->info_venditore[0]->orario_lun;
            $orario_mar = $decoded_json->info_venditore[0]->orario_mar;
            $orario_mer = $decoded_json->info_venditore[0]->orario_mer;
            $orario_gio = $decoded_json->info_venditore[0]->orario_gio;
            $orario_ven = $decoded_json->info_venditore[0]->orario_ven;
            $orario_sab = $decoded_json->info_venditore[0]->orario_sab;
            $orario_dom = $decoded_json->info_venditore[0]->orario_dom;

            $esercente = $decoded_json->stampe[0]->esercente;
            $indirizzo = $decoded_json->stampe[0]->indirizzo;
            $localita = $decoded_json->stampe[0]->localita;
            $telefono = $decoded_json->stampe[0]->telefono;
            $testo_contanti = $decoded_json->stampe[0]->testo_contanti;
            $testo_prezzo = $decoded_json->stampe[0]->testo_prezzo;
            $testo_resto = $decoded_json->stampe[0]->testo_resto;
            $testo_credito_rimanente = $decoded_json->stampe[0]->testo_credito_rimanente;
            $testo_generico1 = $decoded_json->stampe[0]->testo_generico1;
            $testo_generico2 = $decoded_json->stampe[0]->testo_generico2;
            $testo_generico3 = $decoded_json->stampe[0]->testo_generico3;
            $testo_generico4 = $decoded_json->stampe[0]->testo_generico4;

            $layout = $decoded_json->vetrina[0]->layout;
            $layout_card = $decoded_json->vetrina[0]->layout_card;
            
            $this->db->query("DELETE FROM configurazione_macchina 
                                where id_macchina = :id_macchina
                                AND id_esercente = :id_utente");
            // Bind dei parametri
            $this->db->bind(':id_utente', $id_utente);
            $this->db->bind(':id_macchina', $id_macchina);
            
            if($this->db->execute())
                {
                    try {
                    // DELETE OK PUOI FARE INSERT CON DATI AGGIORNATI
                            $this->db->query("INSERT INTO configurazione_macchina
                            (   id,
                                id_macchina,
                                pay_before_selection,
                                limitazioni_eta,
                                vetrina_digitale,
                                continua_vendita,
                                gruppo_tastierino,
                                default_lang,
                                id_esercente,
                                matricola,
                                resto_max,
                                resto_abilitato,
                                timer_vendita,
                                timer_manager,
                                timer_pagina_principale,
                                validita_ticket_settimane,
                                volume_interfaccia,
                                nome_venditore,
                                indirizzo_venditore,
                                localita_venditore,
                                email_venditore,
                                telefono_venditore,
                                fax_venditore,
                                orario_lun,
                                orario_mar,
                                orario_mer,
                                orario_gio,
                                orario_ven,
                                orario_sab,
                                orario_dom,
                                esercente,
                                indirizzo,
                                localita,
                                telefono,
                                testo_contanti,
                                testo_prezzo,
                                testo_resto,
                                testo_credito_rimanente,
                                testo_generico1,
                                testo_generico2,
                                testo_generico3,
                                testo_generico4,
                                layout,
                                layout_card)

                                        VALUES ( null,
                                                        :id_macchina,
                                                        :pay_before_selection,
                                                        :limitazioni_eta,
                                                        :vetrina_digitale,
                                                        :continua_vendita,
                                                        :gruppo_tastierino,
                                                        :default_lang,
                                                        :id_esercente,
                                                        :matricola,
                                                        :resto_max,
                                                        :resto_abilitato,
                                                        :timer_vendita,
                                                        :timer_manager,
                                                        :timer_pagina_principale,
                                                        :validita_ticket_settimane,
                                                        :volume_interfaccia,
                                                        :nome_venditore,
                                                        :indirizzo_venditore,
                                                        :localita_venditore,
                                                        :email_venditore,
                                                        :telefono_venditore,
                                                        :fax_venditore,
                                                        :orario_lun,
                                                        :orario_mar,
                                                        :orario_mer,
                                                        :orario_gio,
                                                        :orario_ven,
                                                        :orario_sab,
                                                        :orario_dom,
                                                        :esercente,
                                                        :indirizzo,
                                                        :localita,
                                                        :telefono,
                                                        :testo_contanti,
                                                        :testo_prezzo,
                                                        :testo_resto,
                                                        :testo_credito_rimanente,
                                                        :testo_generico1,
                                                        :testo_generico2,
                                                        :testo_generico3,
                                                        :testo_generico4,
                                                        :layout,
                                                        :layout_card) ");
                            
                            // Bind dei parametri
                            $this->db->bind(':id_macchina', $id_macchina);
                            $this->db->bind(':pay_before_selection', $pay_before_selection);
                            $this->db->bind(':limitazioni_eta', $limitazioni_eta);
                            $this->db->bind(':vetrina_digitale', $vetrina_digitale);
                            $this->db->bind(':continua_vendita', $continua_vendita);
                            $this->db->bind(':gruppo_tastierino', $gruppo_tastierino);
                            
                            $this->db->bind(':default_lang', $default_lang);
                            $this->db->bind(':id_esercente', $id_esercente);
                            $this->db->bind(':matricola', $matricola);
                            $this->db->bind(':resto_max', $resto_max);
                            $this->db->bind(':resto_abilitato', $resto_abilitato);
                            $this->db->bind(':timer_vendita', $timer_vendita);
                            $this->db->bind(':timer_manager', $timer_manager);
                            $this->db->bind(':timer_pagina_principale', $timer_pagina_principale);
                            $this->db->bind(':validita_ticket_settimane', $validita_ticket_settimane);
                            $this->db->bind(':volume_interfaccia', $volume_interfaccia);
                            
                            $this->db->bind(':nome_venditore', $nome_venditore);
                            $this->db->bind(':indirizzo_venditore', $indirizzo_venditore);
                            $this->db->bind(':localita_venditore', $localita_venditore);
                            $this->db->bind(':email_venditore', $email_venditore);
                            $this->db->bind(':telefono_venditore', $telefono_venditore);
                            $this->db->bind(':fax_venditore', $fax_venditore);
                            $this->db->bind(':orario_lun', $orario_lun);
                            $this->db->bind(':orario_mar', $orario_mar);
                            $this->db->bind(':orario_mer', $orario_mer);
                            $this->db->bind(':orario_gio', $orario_gio);
                            $this->db->bind(':orario_ven', $orario_ven);
                            $this->db->bind(':orario_sab', $orario_sab);
                            $this->db->bind(':orario_dom', $orario_dom);
                            $this->db->bind(':esercente', $esercente);
                            $this->db->bind(':indirizzo', $indirizzo);
                            $this->db->bind(':localita', $localita);
                            $this->db->bind(':telefono', $telefono);
                            $this->db->bind(':testo_contanti', $testo_contanti);
                            $this->db->bind(':testo_prezzo', $testo_prezzo);
                            $this->db->bind(':testo_resto', $testo_resto);
                            $this->db->bind(':testo_credito_rimanente', $testo_credito_rimanente);
                            $this->db->bind(':testo_generico1', $testo_generico1);
                            $this->db->bind(':testo_generico2', $testo_generico2);
                            $this->db->bind(':testo_generico3', $testo_generico3);
                            $this->db->bind(':testo_generico4', $testo_generico4);
                            $this->db->bind(':layout', $layout);
                            $this->db->bind(':layout_card', $layout_card);
                            $this->db->execute();
                           
                                    // TUTTO OK
                                    return ['risposta'=>'ok'];
                                } catch (PDOException $e) {
                                        return $this->db->getError(); 
                                }

                } else {
                            // Handle errors
                            return $this->db->getError(); 
                        }
    } // END SERVIZIO CONFIG
       
} // END METHOD ******************************************************


/** 
 * Metodo carica_json_banner 
 * inserisce i dati del Json provenienti dalla macchina
 * @param int $id_esercente
 * @param int $id_macchina
 */ 
public function carica_json_banner($servizio, $JsonDATA = null, $id_utente, $id_macchina) {
    
    if ( !$JsonDATA ) {
        return false;
        die('NO JSON DATA');
    }

    $decoded_json = json_decode($JsonDATA, false);

    if ($servizio == 'banner') { 

    // CAMPI JSON
    // il campo images contiene un array di nomi per cui devo ciclare per la lunghezza dell'array e fare tante insert quante sono le immagini
  
            $this->db->query("DELETE FROM banner 
                                where id_macchina = :id_macchina
                                AND id_esercente = :id_utente");
            // Bind dei parametri
            $this->db->bind(':id_utente', $id_utente);
            $this->db->bind(':id_macchina', $id_macchina);
            
           
            if($this->db->execute())
                {
                    try {
                        foreach( $decoded_json as $key1 => $val1) {   
                            $id = $decoded_json[$key1]->id;
                            $enabled = $decoded_json[$key1]->enabled; 
                            // ciclo per ogni immagine nell'array
                            foreach( $decoded_json[$key1]->images as $key => $val) {
                                $image = $val;
                                // DELETE OK PUOI FARE INSERT CON DATI AGGIORNATI
                                $this->db->query("INSERT INTO banner
                                (   id_chiave,
                                    id,
                                    images,
                                    abilitato,
                                    id_esercente,
                                    id_macchina)

                                            VALUES ( null,    
                                                            :id,
                                                            :images,
                                                            :abilitato,
                                                            :id_esercente,
                                                            :id_macchina) ");
                                
                                            // Bind dei parametri
                                            $this->db->bind(':id', $id);
                                            $this->db->bind(':images', $image);
                                            $this->db->bind(':abilitato', $enabled);
                                            $this->db->bind(':id_esercente', $id_utente);
                                            $this->db->bind(':id_macchina', $id_macchina);
                                        
                                            $this->db->execute();
                            
                                    } // END FOR EACH IMMAGINI
                            }
                        
                                            // TUTTO OK
                                            return ['risposta'=>'ok'];
                            
                    } catch (PDOException $e) {
                            return $this->db->getError(); 
                    }

                } else {
                            // Handle errors
                            return $this->db->getError(); 
                        }
    } // END SERVIZIO BANNER
} // END METHOD  ******************************************************


/** 
 * Metodo carica_json_catalogoesercente 
 * inserisce i dati del Json provenienti dalla macchina
 * @param int $id_esercente
 * @param int $id_macchina
 */ 
public function carica_json_catalogoesercente($servizio, $JsonDATA = null, $id_utente, $id_macchina) {
    
    if ( !$JsonDATA ) {
        return false;
        die('NO JSON DATA');
    }

    $decoded_json = json_decode($JsonDATA, false);

    if ($servizio == 'catalogoesercente') { 

            $this->db->query("DELETE FROM catalogo_esercente 
                                where macchina_esercente_id = :macchina_esercente_id
                                AND utente_id = :id_utente");
            // Bind dei parametri
            $this->db->bind(':id_utente', $id_utente);
            $this->db->bind(':macchina_esercente_id', $id_macchina);
            
           
            if($this->db->execute())
                {
                    foreach( $decoded_json as $key1 => $val1) {   
                        // CAMPI JSON
                            $id = $decoded_json[$key1]->id;
                            $codice_a_barre = $decoded_json[$key1]->codice_a_barre;
                            $descrizione = $decoded_json[$key1]->descrizione;
                            $immagine = $decoded_json[$key1]->immagine;
                            $ristretto_per_minori = $decoded_json[$key1]->ristretto_per_minori;
                            $vendibile = $decoded_json[$key1]->vendibile;
                            $vendibile_via_web = $decoded_json[$key1]->vendibile_via_web;
                            $profondita = $decoded_json[$key1]->profondita;
                            $prezzo = $decoded_json[$key1]->prezzo;
                            $prezzo_scontato = $decoded_json[$key1]->prezzo_scontato;
                            $iva_id = $decoded_json[$key1]->iva_id;
                            $utente_id = $decoded_json[$key1]->utente_id;
                            $macchina_esercente_id = $decoded_json[$key1]->macchina_esercente_id;
                            $catalogo_tipologia_id = $decoded_json[$key1]->catalogo_tipologia_id;
                            $titolo = $decoded_json[$key1]->titolo;
                            $minuti = $decoded_json[$key1]->minuti;
                     
                                // DELETE OK PUOI FARE INSERT CON DATI AGGIORNATI
                                $this->db->query("INSERT INTO catalogo_esercente
                                                            (   id,
                                                                codice_a_barre,
                                                                descrizione,
                                                                immagine,
                                                                macchina_esercente_id,
                                                                catalogo_tipologia_id,
                                                                ristretto_per_minori,
                                                                vendibile,
                                                                vendibile_via_web,
                                                                larghezza,
                                                                profondita,
                                                                prezzo,
                                                                prezzo_scontato,
                                                                iva_id,
                                                                utente_id,
                                                                titolo,
                                                                minuti)

                                                        VALUES (    :id,    
                                                                    :codice_a_barre,
                                                                    :descrizione,
                                                                    :immagine,
                                                                    :macchina_esercente_id,
                                                                    :catalogo_tipologia_id,
                                                                    :ristretto_per_minori,
                                                                    :vendibile,
                                                                    :vendibile_via_web,
                                                                    :larghezza,
                                                                    :profondita,
                                                                    :prezzo,
                                                                    :prezzo_scontato,
                                                                    :iva_id,
                                                                    :utente_id,
                                                                    :titolo,
                                                                    :minuti) ");
                                
                                            // Bind dei parametri
                                            $this->db->bind(':id', $id);
                                            $this->db->bind(':codice_a_barre', $codice_a_barre);
                                            $this->db->bind(':descrizione', $descrizione);
                                            $this->db->bind(':immagine', $immagine);
                                            $this->db->bind(':macchina_esercente_id', $macchina_esercente_id);
                                            $this->db->bind(':catalogo_tipologia_id', $catalogo_tipologia_id);
                                            $this->db->bind(':ristretto_per_minori', $ristretto_per_minori);
                                            $this->db->bind(':vendibile', $vendibile);
                                            $this->db->bind(':vendibile_via_web', $vendibile_via_web);
                                            $this->db->bind(':larghezza', 0);
                                            $this->db->bind(':profondita', $profondita);
                                            $this->db->bind(':prezzo', $prezzo);
                                            $this->db->bind(':prezzo_scontato', $prezzo_scontato);
                                            $this->db->bind(':iva_id', $iva_id);
                                            $this->db->bind(':utente_id', $utente_id);
                                            $this->db->bind(':titolo', $titolo);
                                            $this->db->bind(':minuti', $minuti);
                                            
                                            try {
                                                $this->db->execute();
                                               
                                            } catch (PDOException $e) {
                                                    return $this->db->getError(); 
                                            }
                                        } // END FOR EACH
                                                 // TUTTO OK
                                                 return ['risposta'=>'ok'];
                            
                    } else {
                                // Handle errors
                                return $this->db->getError(); 
                            }
    } // END SERVIZIO CATALOGO ESERCENTE
} // END METHOD  ******************************************************

/** 
 * Metodo carica_json_catalogo 
 * inserisce i dati del Json provenienti dalla macchina
 * @param int $id_esercente
 * @param int $id_macchina
 */ 
public function carica_json_catalogo($servizio, $JsonDATA = null) {
    
    if ( !$JsonDATA ) {
        return false;
        die('NO JSON DATA');
    }

    $decoded_json = json_decode($JsonDATA, false);

    if ($servizio == 'catalogo') { 
            // SVUOTO INTERO CATALOGO GENERALE
            $this->db->query("DELETE FROM catalogo_generale ");
           
           
            if($this->db->execute())
                {
                    foreach( $decoded_json as $key1 => $val1) {   
                        // CAMPI JSON
                            $id = $decoded_json[$key1]->id;
                            $codice_a_barre = $decoded_json[$key1]->codice_a_barre;
                            $descrizione = $decoded_json[$key1]->descrizione;
                            $immagine = $decoded_json[$key1]->immagine;
                            $ristretto_per_minori = $decoded_json[$key1]->ristretto_per_minori;
                            $vendibile = $decoded_json[$key1]->vendibile;
                            $vendibile_via_web = $decoded_json[$key1]->vendibile_via_web;
                            $larghezza = $decoded_json[$key1]->larghezza;
                            $profondita = $decoded_json[$key1]->profondita;
                            $prezzo = $decoded_json[$key1]->prezzo;
                            $prezzo_scontato = $decoded_json[$key1]->prezzo_scontato;
                            $iva_id = $decoded_json[$key1]->iva_id;
                           
                            $catalogo_tipologia_id = $decoded_json[$key1]->catalogo_tipologia_id;
                            $titolo = $decoded_json[$key1]->titolo;
                            $categoria = $decoded_json[$key1]->categoria;
                            $corrispettivi = $decoded_json[$key1]->corrispettivi;
                            $brand = $decoded_json[$key1]->brand;
                           
                     
                                // DELETE OK PUOI FARE INSERT CON DATI AGGIORNATI
                                $this->db->query("INSERT INTO catalogo_generale
                                                            (   id,
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
                                                                corrispettivi,
                                                                brand)

                                                        VALUES (    :id,    
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
                                                                    :corrispettivi,
                                                                    :brand) ");
                                
                                            // Bind dei parametri
                                            $this->db->bind(':id', $id);
                                            $this->db->bind(':codice_a_barre', $codice_a_barre);
                                            $this->db->bind(':descrizione', $descrizione);
                                            $this->db->bind(':immagine', $immagine);
                                            
                                            $this->db->bind(':catalogo_tipologia_id', $catalogo_tipologia_id);
                                            $this->db->bind(':ristretto_per_minori', $ristretto_per_minori);
                                            $this->db->bind(':vendibile', $vendibile);
                                            $this->db->bind(':vendibile_via_web', $vendibile_via_web);
                                            $this->db->bind(':larghezza', $larghezza);
                                            $this->db->bind(':profondita', $profondita);
                                            $this->db->bind(':prezzo', $prezzo);
                                            $this->db->bind(':prezzo_scontato', $prezzo_scontato);
                                            $this->db->bind(':iva_id', $iva_id);
                                           
                                            $this->db->bind(':titolo', $titolo);
                                            $this->db->bind(':categoria', $categoria);
                                            $this->db->bind(':corrispettivi', $corrispettivi);
                                            $this->db->bind(':brand', $brand);
                                         
                                            
                                            try {
                                                $this->db->execute();
                                               
                                            } catch (PDOException $e) {
                                                    return $this->db->getError(); 
                                            }
                                        } // END FOR EACH
                                                 // TUTTO OK
                                                 return ['risposta'=>'ok'];
                            
                    } else {
                                // Handle errors
                                return $this->db->getError(); 
                            }
    } // END SERVIZIO CATALOGO GENERALE
} // END METHOD  ******************************************************

/** 
 * Metodo carica_json_vetrina_digitale
 * inserisce i dati del Json provenienti dalla macchina
 * @param int $id_esercente
 * @param int $id_macchina
 */ 
public function carica_json_vetrina_digitale($servizio, $JsonDATA = null, $id_utente, $id_macchina) {
    
    if ( !$JsonDATA ) {
        return false;
        die('NO JSON DATA');
    }

    $decoded_json = json_decode($JsonDATA, false);

    if ($servizio == 'vetrina') { 
            // SVUOTO VETRINA
            $this->db->query("DELETE FROM macchine_vetrine_digitali 
                                where id_macchina = :macchina_esercente_id
                                AND id_esercente = :id_utente");
            // Bind dei parametri
            $this->db->bind(':id_utente', $id_utente);
            $this->db->bind(':macchina_esercente_id', $id_macchina);
           
           
            if($this->db->execute())
                {
                    foreach( $decoded_json as $key1 => $val1) {   
                        // CAMPI JSON
                            $titolo = $decoded_json[$key1]->title;
                            $abilitato = $decoded_json[$key1]->isEnabled;
                            $layout = $decoded_json[$key1]->layout;
                            foreach( $decoded_json[$key1]->slots as $key2 => $val2) {
                              
                                       // $id_slot = $decoded_json->slots[$key2]['id_slot'];
                                       $id_slot = $val2->id_slot;
                                        $prodotto_id = $val2->prodotto_id;
                                         // DELETE OK PUOI FARE INSERT CON DATI AGGIORNATI
                                            $this->db->query("INSERT INTO macchine_vetrine_digitali
                                            (   id,
                                                id_esercente,
                                                id_macchina,
                                                abilitato,
                                                titolo,
                                                layout,
                                                id_slot,
                                                id_prodotto)

                                            VALUES (    NULL,    
                                                        :id_utente,
                                                        :id_macchina,
                                                        :abilitato,
                                                        :titolo,
                                                        :layout,
                                                        :id_slot,
                                                        :prodotto_id) ");
    
                                            // Bind dei parametri
                                            $this->db->bind(':titolo', $titolo);
                                            $this->db->bind(':id_utente', $id_utente);
                                            $this->db->bind(':id_macchina', $id_macchina);
                                            $this->db->bind(':abilitato', $abilitato);
                                            
                                            $this->db->bind(':layout', $layout);
                                            $this->db->bind(':id_slot', $id_slot);
                                            $this->db->bind(':prodotto_id', $prodotto_id);
                                        
                                    
                                            try {
                                                $this->db->execute();
                                            
                                            } catch (PDOException $e) {
                                                    return $this->db->getError(); 
                                            }
                            }
                            /* $prodotto_id = $decoded_json->slots[0]->prodotto_id; */
                            // $id_slot = 11;
                            
                           
                     
                               
                                        } // END FOR EACH
                                                 // TUTTO OK
                                                 return ['risposta'=>'ok'];
                            
                    } else {
                                // Handle errors
                                return $this->db->getError(); 
                            }
    } // END SERVIZIO VETRINA DIGITALE
} // END METHOD  ******************************************************

/** 
 * Metodo carica_json_vetrina_digitale_categorie
 * inserisce i dati del Json provenienti dalla macchina
 * @param int $id_esercente
 * @param int $id_macchina
 */ 
public function carica_json_vetrina_digitale_categorie($servizio, $JsonDATA = null, $id_utente, $id_macchina) {
    
    if ( !$JsonDATA ) {
        return false;
        die('NO JSON DATA');
    }

    $decoded_json = json_decode($JsonDATA, false);

    if ($servizio == 'vetrina_categorie') { 
          /*   // SVUOTO CATEGORIE
            $this->db->query("DELETE FROM macchine_vetrine_digitali_categorie 
                                where id_tipologia = :macchina_esercente_id
                                AND id_esercente = :id_utente");
            // Bind dei parametri
            $this->db->bind(':id_utente', $id_utente);
            $this->db->bind(':macchina_esercente_id', $id_macchina); */
           
           
            if($this->db->execute())
                {
                    foreach( $decoded_json as $key1 => $val1) {   
                        // CAMPI JSON
                            $tipologia = $decoded_json->farmacia;

                            foreach( $tipologia[0] as $key2 => $val2) {
                                //return 'key = ' . $key2 . ' val = '.$val2;
                                
                                if ( $key2 == 'label') {
                                    $label =$val2;
                                }

                                if ( $key2 == 'id') {
                                    $id_label =$val2;
                                }
                               
                                // $label = $decoded_json[$key1]->label;
                                // $id_label = $key2['id'];
                           
                                         // DELETE OK PUOI FARE INSERT CON DATI AGGIORNATI
                                            $this->db->query("INSERT INTO macchine_vetrine_digitali_categorie
                                            (   id,
                                                id_tipologia,
                                                id_categoria,
                                                label)

                                            VALUES (    NULL,    
                                                        :tipologia,
                                                        :id_macchina,
                                                        :label) ");
    
                                            // Bind dei parametri
                                            $this->db->bind(':tipologia', $tipologia);
                                            $this->db->bind(':label', $label);
                                            $this->db->bind(':id_label', $id_label);
                                          
                                            try {
                                                $this->db->execute();
                                            
                                            } catch (PDOException $e) {
                                                    return $this->db->getError(); 
                                            }
                          
                               
                                        } // END FOR EACH
                                                 // TUTTO OK
                                                 return ['risposta'=>'ok'];
                                    }
                            
                    } else {
                                // Handle errors
                                return $this->db->getError(); 
                            }
    } // END SERVIZIO VETRINA CATEGORIE
} // END METHOD  ******************************************************


/** 
 * Metodo carica_json_contabilita_motori 
 * inserisce i dati del Json provenienti dalla macchina
 * @param int $id_esercente
 * @param int $id_macchina
 */ 
public function carica_json_contabilita_motori($servizio, $JsonDATA = null, $id_utente, $id_macchina) {
    
    if ( !$JsonDATA ) {
        return false;
        die('NO JSON DATA');
    }

    $decoded_json = json_decode($JsonDATA, false);

    if ($servizio == 'contabilita_motori') { 
            // SVUOTO 
            $this->db->query("DELETE FROM contabilita_motori 
                    where id_macchina = :macchina_esercente_id
                    AND id_esercente = :id_utente");
                    // Bind dei parametri
                    $this->db->bind(':id_utente', $id_utente);
                    $this->db->bind(':macchina_esercente_id', $id_macchina);
           
           
            if($this->db->execute())
                {
                    foreach( $decoded_json as $key1 => $val1) {   
                        // CAMPI JSON
                            $incasso = $decoded_json[$key1]->incasso;
                            $titolo_prodotto = $decoded_json[$key1]->titolo_prodotto;
                            $motore = $decoded_json[$key1]->motore;
                            $alias = $decoded_json[$key1]->alias;
                            $prodotto = $decoded_json[$key1]->prodotto;
                           
                            $id_esercente = $id_utente;
                            $id_macchina = $id_macchina;
                           
                     
                                // DELETE OK PUOI FARE INSERT CON DATI AGGIORNATI
                                $this->db->query("INSERT INTO contabilita_motori
                                                            (   id,
                                                                incasso,
                                                                titolo_prodotto,
                                                                motore,
                                                                alias,
                                                                prodotto,
                                                                id_esercente,
                                                                id_macchina)

                                                        VALUES (    null,    
                                                                    :incasso,
                                                                    :titolo_prodotto,
                                                                    :motore,
                                                                    :alias,
                                                                    :prodotto,
                                                                    :id_esercente,
                                                                    :id_macchina) ");
                                
                                            // Bind dei parametri
                                            $this->db->bind(':incasso', $incasso);
                                            $this->db->bind(':titolo_prodotto', $titolo_prodotto);
                                            $this->db->bind(':motore', $motore);
                                            $this->db->bind(':alias', $alias);
                                            
                                            $this->db->bind(':prodotto', $prodotto);
                                           
                                            $this->db->bind(':id_esercente', $id_esercente);
                                            $this->db->bind(':id_macchina', $id_macchina);
                                           
                                            
                                            try {
                                                $this->db->execute();
                                               
                                            } catch (PDOException $e) {
                                                    return $this->db->getError(); 
                                            }
                                        } // END FOR EACH
                                                 // TUTTO OK
                                                 return ['risposta'=>'ok'];
                            
                    } else {
                                // Handle errors
                                return $this->db->getError(); 
                            }
    } // END SERVIZIO CONTABILITA MOTORI
} // END METHOD  ******************************************************

/** 
 * Metodo carica_json_contabilita_motori 
 * inserisce i dati del Json provenienti dalla macchina
 * @param int $id_esercente
 * @param int $id_macchina
 */ 
public function carica_json_tickets($servizio, $JsonDATA = null, $id_utente, $id_macchina) {
    
    if ( !$JsonDATA ) {
        return false;
        die('NO JSON DATA');
    }

    $decoded_json = json_decode($JsonDATA, false);

    if ($servizio == 'tickets') { 
            // SVUOTO 
            $this->db->query("DELETE FROM tickets 
                                where id_macchina = :macchina_esercente_id
                                AND id_esercente = :id_utente");
                                // Bind dei parametri
                                $this->db->bind(':id_utente', $id_utente);
                                $this->db->bind(':macchina_esercente_id', $id_macchina);
           
           
            if($this->db->execute())
                {
                    foreach( $decoded_json as $key1 => $val1) {   
                        // CAMPI JSON
                            $id_ticket = $decoded_json[$key1]->id;
                            $abilitato = $decoded_json[$key1]->enabled;
                            $credito = $decoded_json[$key1]->credito;
                            $dataticket = $decoded_json[$key1]->date;
                            $validity = $decoded_json[$key1]->validity;
                            $tipo = $decoded_json[$key1]->type;
                           
                            $id_esercente = $id_utente;
                            $id_macchina = $id_macchina;
                           
                     
                                // DELETE OK PUOI FARE INSERT CON DATI AGGIORNATI
                                $this->db->query("INSERT INTO tickets
                                                            (   id,
                                                                id_ticket,
                                                                abilitato,
                                                                credito,
                                                                dataticket,
                                                                validity,
                                                                tipo,
                                                                id_esercente,
                                                                id_macchina)

                                                        VALUES (    null,    
                                                                    :id_ticket,
                                                                    :abilitato,
                                                                    :credito,
                                                                    :dataticket,
                                                                    :validity,
                                                                    :tipo,
                                                                    :id_esercente,
                                                                    :id_macchina) ");
                                
                                            // Bind dei parametri
                                            $this->db->bind(':id_ticket', $id_ticket);
                                            $this->db->bind(':abilitato', $abilitato);
                                            $this->db->bind(':credito', $credito);
                                            $this->db->bind(':dataticket', $dataticket);
                                            
                                            $this->db->bind(':validity', $validity);
                                            $this->db->bind(':tipo', $tipo);
                                           
                                            $this->db->bind(':id_esercente', $id_esercente);
                                            $this->db->bind(':id_macchina', $id_macchina);
                                           
                                            
                                            try {
                                                $this->db->execute();
                                               
                                            } catch (PDOException $e) {
                                                    return $this->db->getError(); 
                                            }
                                        } // END FOR EACH
                                                 // TUTTO OK
                                                 return ['risposta'=>'ok'];
                            
                    } else {
                                // Handle errors
                                return $this->db->getError(); 
                            }
    } // END SERVIZIO CONTABILITA MOTORI
} // END METHOD  ******************************************************

/** 
 * Metodo carica_json_contabilita
 * inserisce i dati del Json provenienti dalla macchina
 * @param int $id_esercente
 * @param int $id_macchina
 */ 
public function carica_json_contabilita($servizio, $JsonDATA = null, $id_utente, $id_macchina) {
    
    if ( !$JsonDATA ) {
        return false;
        die('NO JSON DATA');
    }

    $decoded_json = json_decode($JsonDATA, false);

    if ($servizio == 'contabilita') { 
            // SVUOTO 
            $this->db->query("DELETE FROM contabilita 
                where id_macchina = :macchina_esercente_id
                AND id_esercente = :id_utente");
                // Bind dei parametri
                $this->db->bind(':id_utente', $id_utente);
                $this->db->bind(':macchina_esercente_id', $id_macchina);
           
           
            if($this->db->execute())
                {
                  //  foreach( $decoded_json as $key1 => $val1) {   
                        // CAMPI JSON
                            $incasso = $decoded_json->incasso;
                            $incasso_monete = $decoded_json->incasso_monete;
                            $incasso_banconote = $decoded_json->incasso_banconote;
                            $incasso_pos = $decoded_json->incasso_pos;
                            $incasso_cashless = $decoded_json->incasso_cashless;
                            $incasso_scontrino = $decoded_json->incasso_scontrino;
                            $resto_scontrino = $decoded_json->resto_scontrino;
                            $resto_monete = $decoded_json->resto_monete;
                            $resto_totale = $decoded_json->resto_totale;
                            $totale_venduto = $decoded_json->totale_venduto;
                            $azzeramento_json = $decoded_json->azzeramento;
                            $arr = explode('/', $azzeramento_json);

                            $azzeramento = $arr[2].'-'.$arr[1].'-'.$arr[0]; 

                            $id_esercente = $id_utente;
                            $id_macchina = $id_macchina;
                         
                                // DELETE OK PUOI FARE INSERT CON DATI AGGIORNATI
                                $this->db->query("INSERT INTO contabilita
                                                            (   id,
                                                                incasso,
                                                                incasso_monete,
                                                                incasso_banconote,
                                                                incasso_pos,
                                                                incasso_cashless,
                                                                incasso_scontrino,
                                                                resto_scontrino,
                                                                resto_monete,
                                                                resto_totale,
                                                                totale_venduto,
                                                                azzeramento,
                                                                id_esercente,
                                                                id_macchina)

                                                        VALUES (    null,    
                                                                    :incasso,
                                                                    :incasso_monete,
                                                                    :incasso_banconote,
                                                                    :incasso_pos,
                                                                    :incasso_cashless,
                                                                    :incasso_scontrino,
                                                                    :resto_scontrino,
                                                                    :resto_monete,
                                                                    :resto_totale,
                                                                    :totale_venduto,
                                                                    :azzeramento,
                                                                    :id_esercente,
                                                                    :id_macchina) ");
                                
                                            // Bind dei parametri
                                            $this->db->bind(':incasso', $incasso);
                                            $this->db->bind(':incasso_monete', $incasso_monete);
                                            $this->db->bind(':incasso_banconote', $incasso_banconote);
                                            $this->db->bind(':incasso_pos', $incasso_pos);
                                            
                                            $this->db->bind(':incasso_cashless', $incasso_cashless);
                                            $this->db->bind(':incasso_scontrino', $incasso_scontrino);
                                            $this->db->bind(':resto_scontrino', $resto_scontrino);
                                            $this->db->bind(':resto_monete', $resto_monete);
                                            $this->db->bind(':resto_totale', $resto_totale);
                                            $this->db->bind(':totale_venduto', $totale_venduto);
                                            $this->db->bind(':azzeramento', $azzeramento);
                                            $this->db->bind(':id_esercente', $id_esercente);
                                            $this->db->bind(':id_macchina', $id_macchina);
                                           
                                            try {
                                                $this->db->execute();
                                               
                                            } catch (PDOException $e) {
                                                    return $this->db->getError(); 
                                            }
                         //               } // END FOR EACH
                                                 // TUTTO OK
                                                 return ['risposta'=>'ok'];
                            
                            } else {
                                // Handle errors
                                return $this->db->getError(); 
                            }
    } // END SERVIZIO CONTABILITA'
} // END METHOD  ******************************************************

/** 
 * Metodo carica_json_canale 
 * inserisce i dati del Json provenienti dalla macchina
 * @param int $id_esercente
 * @param int $id_macchina
 */ 
public function carica_json_canale($servizio, $JsonDATA = null, $id_utente, $id_macchina) {
    
    if ( !$JsonDATA ) {
        return false;
        die('NO JSON DATA');
    }

    $decoded_json = json_decode($JsonDATA, false);

    if ($servizio == 'canale') { 


            // SVUOTO INTERO CATALOGO GENERALE
            $this->db->query("DELETE FROM canali_motori 
                            where id_macchina = :id_macchina
                            AND id_esercente = :id_utente");
            // Bind dei parametri
            $this->db->bind(':id_utente', $id_utente);
            $this->db->bind(':id_macchina', $id_macchina);
           
            if($this->db->execute())
                {
                    foreach( $decoded_json as $key1 => $val1) { 
                        $canale = 0;
                        $alias = '';
                        $stato = '';
                        $riga = 0;
                        $prodotto_id = 0;
                        $gruppo = null;
                        $larghezza = 0;
                        $tipo = null;

                        // CAMPI JSON - potrebbero avere valori NULL
                        if ( $canale != 0 ) {
                            $canale = $decoded_json[$key1]->canale;
                        }
                        if ( $decoded_json[$key1]->alias ) {
                            $alias = $decoded_json[$key1]->alias;
                        }
                        if ( $decoded_json[$key1]->stato ) {
                            $stato = $decoded_json[$key1]->stato;
                        }
                        if ( $decoded_json[$key1]->riga ) {
                            $riga = $decoded_json[$key1]->riga;
                        }
                        if ( $decoded_json[$key1]->prodotto_id ) {
                            $prodotto_id = $decoded_json[$key1]->prodotto_id;
                        }
                        if ( $gruppo ) {
                            $group = $decoded_json[$key1]->gruppo;
                        }
                        if ( $decoded_json[$key1]->larghezza ) {
                            $larghezza = $decoded_json[$key1]->larghezza;
                        }
                        if ( $tipo && $tipo != '' ) {
                            $type = $decoded_json[$key1]->tipo;
                        }
                           
                     
                                // INSERT CON DATI AGGIORNATI
                                $this->db->query("INSERT INTO canali_motori
                                                            (   id,
                                                                id_macchina,
                                                                id_esercente,
                                                                canale,
                                                                alias,
                                                                stato,
                                                                riga,
                                                                id_prodotto,
                                                                gruppo,
                                                                larghezza,
                                                                tipo)

                                                        VALUES (    null,    
                                                                    :id_macchina,
                                                                    :id_utente,
                                                                    :canale,
                                                                    :alias,
                                                                    :stato,
                                                                    :riga,
                                                                    :prodotto_id,
                                                                    :group,
                                                                    :larghezza,
                                                                    :tipo) ");
                                
                                            // Bind dei parametri
                                            $this->db->bind(':id_utente', $id_utente);
                                            $this->db->bind(':id_macchina', $id_macchina);
                                            $this->db->bind(':canale', $canale);
                                            $this->db->bind(':alias', $alias);
                                            $this->db->bind(':stato', $stato);
                                            $this->db->bind(':riga', $riga);
                                            
                                            $this->db->bind(':prodotto_id', $prodotto_id);
                                            $this->db->bind(':group', $gruppo);
                                            $this->db->bind(':larghezza', $larghezza);
                                            
                                            $this->db->bind(':tipo', $tipo);
                                         
                                            try {
                                                $this->db->execute();
                                               
                                            } catch (PDOException $e) {
                                                    return $this->db->getError(); 
                                            }
                                        } // END FOR EACH
                                                 // TUTTO OK
                                                 return ['risposta'=>'ok'];
                            } else {
                                // Handle errors
                                return $this->db->getError(); 
                            }  
                   
    } // END SERVIZIO CANALE
} // END METHOD  ******************************************************

/** 
 * Metodo carica_json_network 
 * inserisce i dati del Json provenienti dalla macchina
 * @param int $id_esercente
 * @param int $id_macchina
 */ 
public function carica_json_network($servizio, $JsonDATA = null, $id_utente, $id_macchina) {
    
    if ( !$JsonDATA ) {
        return false;
        die('NO JSON DATA');
    }

    $decoded_json = json_decode($JsonDATA, false);

    if ($servizio == 'network') { 

    // CAMPI JSON
    $localIp_porta = $decoded_json->network[0]->localIp_porta;
    $localApi_ip = $decoded_json->network[0]->localApi_ip;
    $localApi_porta = $decoded_json->network[0]->localApi_porta;
    $cloudApi_ip = $decoded_json->network[0]->cloudApi_ip;
    $cloudApi_utente = $decoded_json->network[0]->cloudApi_utente;
    $cloudApi_psw = $decoded_json->network[0]->cloudApi_psw;
    $cloudApi_token = $decoded_json->network[0]->cloudApi_token;
    $password = $decoded_json->network[0]->password;
    $indirizzo_email = $decoded_json->network[0]->indirizzo_email;

    $IP = $decoded_json->network_system[0]->localIp_ip;
    $netmask = $decoded_json->network_system[0]->netmask;
    $dns_secondario = $decoded_json->network_system[0]->dns_secondario;
    $dns_primario = $decoded_json->network_system[0]->dns_primario;
    $gateway = $decoded_json->network_system[0]->gateway;
    $dhcp = $decoded_json->network_system[0]->dhcp;
    
    
  
            $this->db->query("DELETE FROM configurazione_rete 
                                where id_macchina = :id_macchina
                                AND id_esercente = :id_utente");
            // Bind dei parametri
            $this->db->bind(':id_utente', $id_utente);
            $this->db->bind(':id_macchina', $id_macchina);
            
           
            if($this->db->execute())
                {
                   
                     
                                // DELETE OK PUOI FARE INSERT CON DATI AGGIORNATI
                                $this->db->query("INSERT INTO configurazione_rete
                                                            (   id,
                                                                IP,
                                                                netmask,
                                                                gateway,
                                                                dns_primario,
                                                                dns_secondario,
                                                                utente_tecnico,
                                                                password_tecnico,
                                                                dhcp,
                                                                id_esercente,
                                                                id_macchina,
                                                                localIp_porta,
                                                                localApi_ip,
                                                                localApi_porta,
                                                                cloudApi_ip,
                                                                cloudApi_utente,
                                                                cloudApi_psw,
                                                                cloudApi_token)

                                                        VALUES ( null,    
                                                                    :IP,
                                                                    :netmask,
                                                                    :gateway,
                                                                    :dns_primario,
                                                                    :dns_secondario,
                                                                    :utente_tecnico,
                                                                    :password_tecnico,
                                                                    :dhcp,
                                                                    :id_esercente,
                                                                    :id_macchina,
                                                                    :localIp_porta,
                                                                    :localApi_ip,
                                                                    :localApi_porta,
                                                                    :cloudApi_ip,
                                                                    :cloudApi_utente,
                                                                    :cloudApi_psw,
                                                                    :cloudApi_token) ");
                                
                                            // Bind dei parametri
                                            $this->db->bind(':IP', $IP);
                                            $this->db->bind(':netmask', $netmask);
                                            $this->db->bind(':gateway', $gateway);
                                            $this->db->bind(':dns_primario', $dns_primario);
                                            $this->db->bind(':dns_secondario', $dns_secondario);
                                            $this->db->bind(':utente_tecnico', $indirizzo_email);
                                            $this->db->bind(':password_tecnico', $password);
                                            $this->db->bind(':dhcp', $dhcp);
                                            $this->db->bind(':id_esercente', $id_utente);
                                            $this->db->bind(':id_macchina', $id_macchina);
                                            $this->db->bind(':localIp_porta', $localIp_porta);
                                            $this->db->bind(':localApi_ip', $localApi_ip);
                                            $this->db->bind(':localApi_porta', $localApi_porta);
                                            $this->db->bind(':cloudApi_ip', $cloudApi_ip);
                                            $this->db->bind(':cloudApi_utente', $cloudApi_utente);
                                            $this->db->bind(':cloudApi_psw', $cloudApi_psw);
                                            $this->db->bind(':cloudApi_token', $cloudApi_token);
                                            try {
                                                $this->db->execute();
                                               
                                            } catch (PDOException $e) {
                                                    return $this->db->getError(); 
                                            }
                                                 // TUTTO OK
                                                 return ['risposta'=>'ok'];
                            
                    } else {
                                // Handle errors
                                return $this->db->getError(); 
                            }
    } // END SERVIZIO NETWORK
} // END METHOD  ******************************************************




/** 
 * Metodo scrivi_log_operazioni 
 * inserisce un singolo prodotto nel catalogo esercente
 * @param int $id_utente
 * @param int $id_macchina
 * @param string $endpoint_richiamato
 * @param string $json_file
 */
public function scrivi_log_operazioni( $id_utente, $id_macchina, $endpoint_richiamato, $json_file ){
                

               $this->db->query("INSERT INTO log_operazioni
                            (   id,
                                id_esercente,
                                id_macchina,
                                endpoint_richiamato,
                                json_file)
                                        VALUES ( null,
                                                :id_utente,
                                                :id_macchina,
                                                :endpoint_richiamato,
                                                :json_file) ");
            
            // Bind dei parametri
            $this->db->bind(':id_utente', $id_utente);
            $this->db->bind(':id_macchina', $id_macchina);
            $this->db->bind(':endpoint_richiamato', $endpoint_richiamato);
            $this->db->bind(':json_file', $json_file);
            try {
                    $this->db->execute();
                    // TUTTO OK
                    return 'OK';
                 } catch (PDOException $e) {
                    
                        return $this->db->getError(); 
                    
                 }
 
} // END METHOD registra_secret ******************************************************

/** 
 * Metodo carica_json_contabilita_motori 
 * inserisce i dati del Json provenienti dalla macchina
 * @param int $id_esercente
 * @param int $id_macchina
 */ 
public function carica_json_logs($servizio, $JsonDATA = null, $id_utente, $id_macchina) {
    
    if ( !$JsonDATA ) {
        return false;
        die('NO JSON DATA');
    }

    $decoded_json = json_decode($JsonDATA, false);

    if ($servizio == 'logs') { 
            // SVUOTO 
            $this->db->query("DELETE FROM logs 
                                    where id_macchina = :macchina_esercente_id
                                    AND id_esercente = :id_utente");
                                    // Bind dei parametri
                                    $this->db->bind(':id_utente', $id_utente);
                                    $this->db->bind(':macchina_esercente_id', $id_macchina);
           
           
            if($this->db->execute())
                {
                    foreach( $decoded_json as $key1 => $val1) {   
                        // CAMPI JSON
                            $tipo = $decoded_json[$key1]->type;
                           
                            $id_ticket = $decoded_json[$key1]->message->id;
                            $stato = $decoded_json[$key1]->message->state;
                            $icon = $decoded_json[$key1]->message->icon;
                            $descrizione = $decoded_json[$key1]->message->description;
                            $dataora = $decoded_json[$key1]->date;
                           
                            $id_esercente = $id_utente;
                            $id_macchina = $id_macchina;
                           
                     
                                // DELETE OK PUOI FARE INSERT CON DATI AGGIORNATI
                                $this->db->query("INSERT INTO logs
                                                            (   id,
                                                                tipo,
                                                               
                                                                id_ticket,
                                                                stato,
                                                                icon,
                                                                descrizione,
                                                                dataora,
                                                                id_esercente,
                                                                id_macchina)

                                                        VALUES (    null,    
                                                                    :tipo,
                                                                  
                                                                    :id_ticket,
                                                                    :stato,
                                                                    :icon,
                                                                    :descrizione,
                                                                    :dataora,
                                                                    :id_esercente,
                                                                    :id_macchina) ");
                                
                                            // Bind dei parametri
                                            $this->db->bind(':tipo', $tipo);
                                           
                                            $this->db->bind(':id_ticket', $id_ticket);
                                            $this->db->bind(':stato', $stato);
                                            
                                            $this->db->bind(':icon', $icon);
                                            $this->db->bind(':descrizione', $descrizione);
                                            $this->db->bind(':dataora', $dataora);
                                           
                                            $this->db->bind(':id_esercente', $id_esercente);
                                            $this->db->bind(':id_macchina', $id_macchina);
                                           
                                            
                                            try {
                                                $this->db->execute();
                                               
                                            } catch (PDOException $e) {
                                                    return $this->db->getError(); 
                                            }
                                        } // END FOR EACH
                                                 // TUTTO OK
                                                 return ['risposta'=>'ok'];
                            
                    } else {
                                // Handle errors
                                return $this->db->getError(); 
                            }
    } // END SERVIZIO LOGS
} // END METHOD  ******************************************************







} // END CLASS ******************************************    