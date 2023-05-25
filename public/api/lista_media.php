<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//RICERCA DI TUTTI I PRODOTTI DI UN ESERCENTE IN BASE  ALLA MATICOLA DI MACCHINA  
        // Controllo dati utente
        require_once('../../app/class/class_macchine.php');
    
       
        $id_esercente = filter_input(INPUT_GET, 'ide', FILTER_SANITIZE_NUMBER_INT );
     
    
        $media = new Macchina;
       
      
           $Lista_media =  $media->lista_media($id_esercente);
      
    
    
        if ($Lista_media) {
        
            $content[] = $Lista_media;

        
                    echo json_encode($Lista_media);
            }
            else { 
                echo "Errore lista MEDIA json file...";
            }

        
    

//}


