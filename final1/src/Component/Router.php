<?php

namespace App\Component;

class Router
{
    public function handleRequest(): void
    {
        $path = trim($_SERVER['PATH_INFO'], '/');
        if ($path === '') {
            $path = '/'; //получает страницу на которую зашёл
        }

        $config = require '../src/config.php'; //подтягивает конфиг
        $action = $config['actions'][$path] ?? null; //по этому пути ищет нужный экшен
        if ($action === null) {
            error_log(sprintf('Action %s not found', $path));
            http_response_code(404);
            die();
        }

        if (strtolower($_SERVER['REQUEST_METHOD']) !== strtolower($action['method'])) {//проверяет что используется тот же метод что и в конфиге
            error_log(sprintf('Wrong method %s for action %s with method %s', $_SERVER['REQUEST_METHOD'], $path, strtolower($action['method'])));
            http_response_code(400);
            die();
        }

        if (
            !empty($action['auth'])//если в экшене = тру то пользователь должен зайти
            && (!isset($_SESSION['is_auth']) || !$_SESSION['is_auth'])
        ) {
            SecurityLogger::log(sprintf('Trying access method %s without being authorised', $path));//вызов ошибки если не зашёл
            http_response_code(403);
            die();
        }

        if (!class_exists($action['action'])) {//проверяет что конфиг норм
            error_log(sprintf('Class %s not found for action %s', $action['action'], $path));
            http_response_code(500);
            die();
        }

        $actionObject = new $action['action'];
        if (!$actionObject instanceof ActionInterface) {
            error_log(sprintf('Class %s does not implement ActionInterface', $action['action']));
            http_response_code(500);
            die();
        }

        $actionObject->handle();// вызываем метод
    }
}
