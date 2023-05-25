<?php
error_reporting(E_ERROR | E_PARSE);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//RICERCA DI TUTTI I JSON DI UN ESERCENTE I
       
        $id_esercente = filter_input(INPUT_GET, 'ide', FILTER_SANITIZE_NUMBER_INT );
        $matricola = filter_input(INPUT_GET, 'matricola', FILTER_SANITIZE_SPECIAL_CHARS );


        $elencoJson = array();
    if ($id_esercente && $matricola) {

            $dir    = '../jsontomachine/'; // path from top
            $files = scandir($dir);
            $files_n = count($files);

        
            $i=0;
            while($i<$files_n){
                // "is_dir" only works from top directory, so append the $dir before the file
                if ( is_dir($dir.'/'.$files[$i]) ){  
                    $MyFileType[$i] = "D" ; // D for Directory
                    if ( $files[$i] !== '.') {
                        if ( $files[$i] !== '..' ) {
                           // if ( $files[$i] !== 'catalogogenerale' ) {
                              
                                    $NomeCartelle = scandir(  $dir.$files[$i].'/'.$id_esercente.'/'.$matricola, SCANDIR_SORT_DESCENDING);
                                    foreach ( $NomeCartelle as $key => $nomeFile) {
                                        if ( !is_dir($nomeFile) ) {
                                            $data_file = date ("d/m/Y H:i:s", filemtime( $dir.$files[$i].'/'.$id_esercente.'/'.$matricola.'/'.$nomeFile));
                                            // carico array
                                            array_push( $elencoJson, ["nomefile"=>$nomeFile,"data"=>$data_file,"cartella"=>$files[$i]]   );
                                        }
                                    }

                               
                          //  }

                        }
                    }
                } else{
                    $MyFileType[$i] = "F" ; // F for File
                }
             
                $i++;
            }

            echo json_encode($elencoJson);

        } // END IF DATI GET


