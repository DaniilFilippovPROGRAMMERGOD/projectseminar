<?php

namespace App\Action\Product;

use App\Action\AbstractAction;
use Throwable;

class GetAddProductAction extends AbstractAction
{
    public function handle(): void
    {
        if (!isset($_SESSION['is_auth']) || !$_SESSION['is_auth']) {
            http_response_code(403);
            die();
        }

        try {
            echo $this->twig->render(
                'add-product.html.twig',
                [
                    'product' => null,
                    'isAuth' => true,
                    'login' => $_SESSION['login'],
                ]
            );
        } catch (Throwable $e) {
            error_log($e);
            die(
            json_encode(['status' => 'error', 'message' => 'Failed to add record'], JSON_UNESCAPED_UNICODE)
            );
        }
    }
}
