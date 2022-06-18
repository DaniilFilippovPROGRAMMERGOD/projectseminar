<?php

namespace App\Action\Auth;

use App\Action\AbstractAction;
use Exception;

class LoginAction extends AbstractAction
{
    public function handle(): void
    {
        try {
            $data = $_POST;

            $user = $this->repository->getUserByLogin($data['login']);//пользователь нажмёт на регистрацию и примет 2 параметра логин и пароль

            if (password_verify($data['password'], $user['password'])) {//там хранятся хэш пароли и проверка хэша пароля с тем что хранится в таблице
                session_regenerate_id(true);
                $_SESSION['is_auth'] = true;//пользователь залогинился
                $_SESSION['login'] = $data['login'];

                header('Location: /get-products');//переходим в хедере на главную страницу
                session_write_close();
                die();
            }

            $content = file_get_contents('security.log');//мы пишем в секьюрити лог ошибку

            $content .= 'Неудачная попытка аутентификации ' . PHP_EOL;
            file_put_contents('security.log', $content);

            echo $this->twig->render(
                'login.html.twig',
                [
                    'message' => 'Invalid credentials',//возвращет хтмл
                ]
            );

            session_write_close();
            http_response_code(200);
        } catch (Exception $e) {
            error_log($e);
        }
    }
}
