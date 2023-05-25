<?php 
 // file indice che riceve le richieste e le gira alla /app
// associato quindi alle action delle richieste fatte dal client


//COSTANTE PAGINE  ****


// PTH della Cartella dell'applicazione
defined( 'APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname( __FILE__ ). '/../app' )); 

// costante usata per capire il tipo di separatore di cartella da usare a seconda se server windows o linux
const DS = DIRECTORY_SEPARATOR;


// file ESSENZIAL di configurazione essenziale per tutto il CMS contieie ARRAY con tutti i PATH 
require APPLICATION_PATH. DS . 'config' . DS . 'config.php';

// get è in functions, richiamo quindi la pagina passando il campo page col valore il nome della paginaa che voglio richiamare
$page = get('page', 'login');


// cerco nel model folder la pagina (path reale)
$model = $config['MODEL_PATH'] . $page . '.php';
// cerco la view la pagina
$view = $config['VIEW_PATH'] . $page . '.phtml';
// not found page
$_404 = $config['VIEW_PATH'] . '404.phtml';



// controllo che il model e la view esistano
// altrimenti crica page not found!
if (file_exists( $model )) {
    require $model;
}

$main_content = $_404;

if (file_exists( $view )) {
    $main_content = $view;
} 


if ( $page === 'login') { 
     // Carica il login
    require $view;
   
} else {
    include $config['VIEW_PATH'] . 'layout.phtml';
}


