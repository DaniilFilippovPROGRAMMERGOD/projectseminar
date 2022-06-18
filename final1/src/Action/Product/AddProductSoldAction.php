<?php

namespace App\Action\Product;

use App\Action\AbstractAction;
use RuntimeException;
use Throwable;

class AddProductSoldAction extends AbstractAction
{
    public function handle(): void
    {
        header('Content-type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true, flags: JSON_THROW_ON_ERROR);//данные запроса декодирую из json в массив

            $id = $this->repository->addproductSold($data);//добавит продажу продукта

            if ($id === false) {
                throw new RuntimeException('Ошибка запроса к БД');
            }

            echo json_encode(['status' => 'success', 'id' => $id], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);//добавляет запись в таблицу ProductSold
        } catch (Throwable $e) {
            error_log($e);//запись ошибки
            die(
            json_encode(['status' => 'error', 'message' => 'Failed to add record'], JSON_UNESCAPED_UNICODE)
            );
        }
    }
}
