<?php

namespace App\Action\Auth;

use App\Action\AbstractAction;
use Exception;

class GetLoginAction extends AbstractAction
{
    public function handle(): void
    {
        try {
            echo $this->twig->render(
                'login.html.twig',//возвращает хтмл страницу
            );
        } catch (Exception $e) {
            error_log($e);
        }
    }
}
