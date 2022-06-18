<?php

namespace App\Action\Product;

use App\Action\AbstractAction;
use RuntimeException;
use Throwable;

class UpdateProductAction extends AbstractAction
{
    public function handle(): void
    {
        try {
            $data = $_POST;

            if (!$this->repository->productExists($data['id'])) {
                throw new RuntimeException('Не существует записи в product с id ' . $data['id']);
            }

            $this->repository->updateproduct($data);

            header('Location: /get-products');
            die();
        } catch (Throwable $e) {
            error_log($e);
            echo $this->twig->render(
                'update-product.html.twig',
                [
                    'product' => $data,
                    'isAuth' => isset($_SESSION['is_auth']) && $_SESSION['is_auth'],
                    'login' => $_SESSION['login'],
                    'message' => $e->getMessage(),
                ]
            );
        }
    }
}
