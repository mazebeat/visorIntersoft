<?php

$url            = 'http://192.168.4.70:8080/WsConsumoHpEngine/WsComposeEngine?wsdl';
$method         = 'engineOnline';
$driverName     = 'INXML';
$namePub        = 'ramoAUTOS_V2.pub';
$rutaProperties = 'C:';

/** DON'T TOUCH IT !!!! **/
define('WS_URL', $url); // URL WebService
define('WS_METHOD', $method); // Metodo a consumir para generar Base64
/* Parametros WebService Fijos */
define('WS_DRIVERNAME', $driverName);
define('WS_NAMEPUB', $namePub);
define('WS_RUTAPROPERTIES', $rutaProperties);