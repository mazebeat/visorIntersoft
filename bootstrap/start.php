<?php
header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no cache'); //no cache

function __autoload($className)
{
    $filename = $className . ".php";
    if (is_readable($filename)) {
        require_once $filename;
    }
}

$dir = $_SERVER['DOCUMENT_ROOT'] . '/app/';

include_once $dir . 'models/IniParser.php';

$file    = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'configuration.ini';
$parser  = new \IniParser();
$config  = $parser->parse($file);
$apps    = $config->app;
$wss     = $config->webservice;
$configs = $config->config;

$dh       = opendir($dir);
$dir_list = array($dir);

while (false !== ($filename = readdir($dh))) {
    if ($filename != "." && $filename != ".." && is_dir($dir . $filename)) {
        array_push($dir_list, $dir . $filename . "/");
    }
}

foreach ($dir_list as $dir) {
    foreach (glob($dir . "*.php") as $filename) {
        include_once $filename;
    }
}