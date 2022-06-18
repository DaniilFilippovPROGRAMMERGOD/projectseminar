<?php

namespace App\Action\Product;

use App\Action\AbstractAction;
use Throwable;

class DeleteProductAction extends AbstractAction
{
    public function handle(): void
    {
        try {
            $data = $_POST;
            $this->repository->deleteFromproduct($data['id']);

            header('Location: /get-products');
            die();
        } catch (Throwable $e) {
            error_log($e);

            echo $this->twig->render(
                'delete-product.html.twig',
                [
                    'id' => $data['id'],
                    'isAuth' => isset($_SESSION['is_auth']) && $_SESSION['is_auth'],
                    'login' => $_SESSION['login'],
                    'message' => 'Есть связанные сущности, удаление невозможно',
                ]
            );
        }
    }
}
