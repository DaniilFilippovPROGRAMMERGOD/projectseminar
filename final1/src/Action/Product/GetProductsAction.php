<?php

namespace App\Action\Product;

use App\Action\AbstractAction;
use Throwable;

class GetProductsAction extends AbstractAction
{
    public function handle(): void
    {
        try {
            echo $this->twig->render('products.html.twig', [
                'products' => $this->repository->getAllproducts($_GET),
                'isAuth' => isset($_SESSION['is_auth']) && $_SESSION['is_auth'],
                'login' => $_SESSION['login'],
            ]);
        } catch (Throwable $e) {
            error_log($e);
            echo $this->twig->render('products.html.twig', [
                'products' => [],
                'isAuth' => isset($_SESSION['is_auth']) && $_SESSION['is_auth'],
                'login' => $_SESSION['login'],
            ]);
        }
    }
}
