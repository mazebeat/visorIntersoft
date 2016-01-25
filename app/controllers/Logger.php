<?php

class Logger
{
    const LOG_FILE = LOGGER_PATH;

    /**
     * Logger constructor.
     *
     * @param        $log
     * @param string $status
     * @param int    $code
     */
    public static function logging($log, $status = 'LOGGER', $code = 3)
    {
        try {
            if (!is_writable(self::LOG_FILE)) {
                die('Log file "' . self::LOG_FILE . '" is not writable for PHP!');
            }

            if ($log != '') {
                $log = date('Y-m-d H:i:s') . " [" . $status . "][" . MACHINE . "] " . $log . PHP_EOL;
                error_log(utf8_encode($log), $code, self::LOG_FILE);
            }
        } catch (\Exception $e) {
            error_log($e, 3, self::LOG_FILE);
        }
    }

    /**
     * @param $log
     */
    public static function error($log)
    {
        self::logging($log, 'ERROR');
    }

    /**
     * @param $log
     */
    public static function info($log)
    {
        self::logging($log, 'INFO');
    }

    /**
     * @param $log
     */
    public static function debug($log)
    {
        self::logging($log, 'DEBUG');
    }

    /**
     * @param $log
     */
    public static function warn($log)
    {
        self::logging($log, 'WARNING');
    }
}