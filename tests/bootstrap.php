<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// To suppress the warning during the date() invocation in logs, we would default the timezone to GMT.
if (!ini_get('date.timezone')) {
    date_default_timezone_set('GMT');
}

date_default_timezone_set('America/Sao_Paulo');

$dir = dirname(__DIR__);

define("ROOT_DIR", $dir);

/**
 * Carrega as variáveis de ambiente
 */
$dotenv = Dotenv\Dotenv::createImmutable($dir);
$dotenv->load();


/**
 * Composer autoload
 */
include_once ($dir.'/vendor/autoload.php');

