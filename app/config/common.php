<?php
session_start();


if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) exit('No direct access allowed.');

date_default_timezone_set('Europe/Rome');

if( !isset( $_SESSION['utente_id'] ) ){
    header('Location: index.php');
    exit();
}
