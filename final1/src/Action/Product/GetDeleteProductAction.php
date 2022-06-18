<?php

namespace App\Action\Product;

use App\Action\AbstractAction;
use Throwable;

class GetDeleteProductAction extends AbstractAction
{
    public function handle(): void
    {
        try {
            $id = $_GET['id'];
            echo $this->twig->render(
                'delete-product.html.twig',
                [
                    'id' => $id,
                    'isAuth' => isset($_SESSION['is_auth']) && $_SESSION['is_auth'],
                    'login' => $_SESSION['login'],
                ]
            );
        } catch (Throwable $e) {
            error_log($e);
            die(
            json_encode(['status' => 'error', 'message' => 'Failed to delete record'], JSON_UNESCAPED_UNICODE)
            );
        }
    }
}
