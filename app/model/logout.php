<?php
session_start();
require_once $config['CLASS_PATH'] . 'class_utente.php';

$logout_utente = new Utente;

$logout_utente->distruggi_sessione();
header('Location: index.php');
    exit();