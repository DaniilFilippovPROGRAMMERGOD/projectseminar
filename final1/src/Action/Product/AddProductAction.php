<?php

namespace App\Action\Product;

use App\Action\AbstractAction;
use RuntimeException;
use Throwable;

class AddProductAction extends AbstractAction
{
    public function handle(): void
    {
        try {
            $data = $_POST;//добавляет дату

            $id = $this->repository->addproduct($data);//добавляет айдишник из переданных данных

            if ($id === false) {
                throw new RuntimeException('Ошибка запроса к БД');
            }

            header('Location: /get-product?id=' . $id);//переход на страницу по нашему айди
        } catch (Throwable $e) {
            error_log($e);//записать ошибку

            echo $this->twig->render(//шаблонизатор рисует html страницы
                'add-product.html.twig',
                [
                    'product' => null,
                    'isAuth' => true,
                    'login' => $_SESSION['login'],
                    'message' => $e->getMessage(),
                ]
            );
        }
    }
}
