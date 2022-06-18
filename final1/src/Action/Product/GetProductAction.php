<?php

namespace App\Action\Product;

use App\Action\AbstractAction;
use RuntimeException;
use Throwable;

class GetProductAction extends AbstractAction
{
    public function handle(): void
    {
        try {
            if (!array_key_exists('id', $_GET)) {
                throw new RuntimeException('Не задан параметр id');
            }

            $id = $_GET['id'];

            echo $this->twig->render('product.html.twig', [
                'product' => $this->repository->getproductInfoById($id),
                'isAuth' => isset($_SESSION['is_auth']) && $_SESSION['is_auth'],
                'login' => $_SESSION['login'],
            ]);
        } catch (Throwable $e) {
            error_log($e);
            echo $this->twig->render('product.html.twig', [
                'product' => null,
                'isAuth' => isset($_SESSION['is_auth']) && $_SESSION['is_auth'],
                'login' => $_SESSION['login'],
            ]);
        }
    }
}
