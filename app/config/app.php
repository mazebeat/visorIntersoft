<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Santiago');
ini_set("max_execution_time", 0);

/** DON'T TOUCH IT !!!! **/
/* ROUTES */
define('HOME', $_SERVER['DOCUMENT_ROOT'] . '/');
define('APP', HOME . '/app');
define('PUBLIC', HOME . '/public');
define('CONTROLLERS', APP . '/controllers');
define('STORAGE', APP . '/storage');

/* MACHINE NAME */
$machine = "";
if (isset($_SERVER['HTTP_CLIENT_IP'])) {
    $machine = $_SERVER['HTTP_CLIENT_IP'];
} else {
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $machine = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $machine = $_SERVER['HTTP_X_FORWARDED'];
        } else {
            if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
                $machine = $_SERVER['HTTP_FORWARDED_FOR'];
            } else {
                if (isset($_SERVER['HTTP_FORWARDED'])) {
                    $machine = $_SERVER['HTTP_FORWARDED'];
                } else {
                    if (isset($_SERVER['REMOTE_ADDR'])) {
                        $machine = $_SERVER['REMOTE_ADDR'];
                    } else {
                        $machine = 'UNKNOWN';
                    }
                }
            }
        }
    }
}

define('MACHINE', $machine);