<?php

include 'config.php';

if (!file_exists("logs/")) {
    mkdir("logs/", 0777);
}

ini_set("log_errors", 1);
ini_set('error_log', LOGS_PATH.DS.'php.log');

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

spl_autoload_register(function ($className) {
    require str_replace('\\', DS, APPLICATION_ROOT . $className . '.php');
});
try {
    include 'route.php';
} catch (Exception $exception) {
    file_put_contents(LOGS_PATH . DS . 'exceptions.log', $exception . "\n\n", FILE_APPEND);
}
