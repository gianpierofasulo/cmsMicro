<?php

/* 
 *  
 * legge i parametri e prende i valori
 */

// riceve il nome del parametro e in casonon esste ne passa uno di dffault
function get($name, $def) {
    // restituisce il valore del parametro se esiste, altrimenti passa quello di default $def
    // serve a proteggere le richieste in quanto se una variabile non fà parte della richiesta viene
    // passaro il valore di default
    return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $def;
    
}

