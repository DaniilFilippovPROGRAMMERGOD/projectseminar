<?php

namespace App\Action\Shopper;

use App\Action\AbstractAction;
use RuntimeException;
use Throwable;

class AddShopperAction extends AbstractAction
{
    public function handle(): void
    {
        header('Content-type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true, flags: JSON_THROW_ON_ERROR);

            $id = $this->repository->addshopper($data);

            if ($id === false) {
                throw new RuntimeException('Ошибка запроса к БД');
            }

            echo json_encode(['status' => 'success', 'id' => $id], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            error_log($e);
            die(
            json_encode(['status' => 'error', 'message' => 'Failed to add record'], JSON_UNESCAPED_UNICODE)
            );
        }
    }
}
