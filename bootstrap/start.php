<?php
header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no cache'); //no cache

$dir      = $_SERVER['DOCUMENT_ROOT'] . '/app/';
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

function __autoload($className)
{
    $filename = $className . ".php";
    if (is_readable($filename)) {
        require_once $filename;
    }
}

// Logger::info('INIT APP');