<?php

$path             = STORAGE . '/sessions';
$timeout_duration = 10; // Minutos

/** DON'T TOUCH IT !!!! **/
ini_set('session.gc_probability', 0);
ini_set('session.gc_maxlifetime', $timeout_duration);
ini_set('session.save_path', $path);
session_cache_limiter('private_no_expire');

if (!is_writable(session_save_path())) {
    die('Session path "' . session_save_path() . '" is not writable for PHP!');
}
session_start();

if (isset($_SESSION['LAST_ACTIVITY'])) {
    if ($_SESSION['LAST_ACTIVITY'] + $timeout_duration * 60 < time()) {
        session_unset();
        session_destroy();
        session_start();
    }
} else {
    $_SESSION['LAST_ACTIVITY'] = time();
    $_SESSION['ID_MACHINE']    = session_id();
}