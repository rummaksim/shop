<?php
    // FRONT CONTROLLER

    // Настройки отображения ошибок
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    //инициализация сессии
    session_start();

    //Подключение необходимых файлов
    define('ROOT', dirname(__FILE__));

    require_once (ROOT.'/components/Autoload.php');

    //Вызов Router
    $router = new Router();
    $router->run();
