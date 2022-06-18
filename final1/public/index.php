<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';//подключает автолоадер - для поиска класса
//require_once 'autoload.php';

use App\Component\Router;

session_set_cookie_params([
    'lifetime' => 60 * 60 * 24, // 24 часа //параметры куки
    'httponly' => true, //чтобы js не мог читать куку
    'samesite' => 'Strict'//чтобы с других доменов не действовала кука
]);

session_name('fdsgjraoifjdfasdjfl'); //чтобы злоумышленнику тяжелее было найти
session_start();

error_reporting(E_ERROR | E_PARSE);
ini_set('log_errors', '1');//
ini_set('error_log', '../error.log');//ошибки надо писать в файл error log

(new Router())->handleRequest();//создаёт объект роутера и вызываем метод реквест
