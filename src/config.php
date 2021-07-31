<?php

define('DS',DIRECTORY_SEPARATOR);

define('DB_CONN','mysql:host=db;dbname=magebit');
define('DB_USER','root');
define('DB_PASSWORD','password123');

define('APPLICATION_ROOT', $_SERVER['DOCUMENT_ROOT'].DS);
define('TEMPLATE_ROOT', APPLICATION_ROOT.'View'.DS);
define('LOGS_PATH', APPLICATION_ROOT . DS . 'logs');
