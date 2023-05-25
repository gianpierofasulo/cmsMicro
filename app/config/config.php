<?php


// Definizione di tutti i path
$config = [
    'MODEL_PATH' => APPLICATION_PATH . DS . 'model' . DS,
    'VIEW_PATH' => APPLICATION_PATH . DS . 'view' . DS,
    'LIB_PATH' => APPLICATION_PATH . DS . 'lib' . DS,
    'CLASS_PATH' => APPLICATION_PATH . DS . 'class' . DS,
    'API_PATH' => APPLICATION_PATH . DS . 'api' . DS,
    'VENDOR_PATH' => APPLICATION_PATH . DS . 'vendor' . DS,
    'CONFIG_PATH' => APPLICATION_PATH . DS . 'config' . DS,
    'XCRUD_PATH' => APPLICATION_PATH . DS . 'xcrud' . DS,
    'PHPMAILER_PATH' => APPLICATION_PATH . DS . 'PHPMailer' . DS
];

require $config['LIB_PATH'] . 'functions.php';

