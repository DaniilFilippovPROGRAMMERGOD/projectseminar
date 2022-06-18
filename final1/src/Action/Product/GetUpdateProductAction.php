<?php

namespace App\Action\Product;

use App\Action\AbstractAction;
use RuntimeException;
use Throwable;

class GetUpdateProductAction extends AbstractAction
{
    public function handle(): void
    {
        try {
            $id = $_GET['id'];

            if (!$this->repository->productExists($id)) {
                throw new RuntimeException('Не существует записи в product с id ' . $id);
            }

            $product = $this->repository->getproductInfoById($id);
            $product['quality_control_id'] = $product['quality_control']['id'];
            $product['supplier_id'] = $product['supplier']['id'];

            echo $this->twig->render(
                'update-product.html.twig',
                [
                    'product' => $product,
                    'isAuth' => isset($_SESSION['is_auth']) && $_SESSION['is_auth'],
                    'login' => $_SESSION['login'],
                ]
            );
        } catch (Throwable $e) {
            error_log($e);
            echo $this->twig->render(
                'update-product.html.twig',
                [
                    'product' => null,
                    'isAuth' => isset($_SESSION['is_auth']) && $_SESSION['is_auth'],
                    'login' => $_SESSION['login'],
                ]
            );
        }
    }
}
