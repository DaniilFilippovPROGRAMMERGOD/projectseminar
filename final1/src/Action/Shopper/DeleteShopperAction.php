<?php

namespace App\Action\Shopper;

use App\Action\AbstractAction;
use Throwable;

class DeleteShopperAction extends AbstractAction
{
    public function handle(): void
    {
        header('Content-type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true, flags: JSON_THROW_ON_ERROR);

            $this->repository->deleteshopper($data['id']);

            echo json_encode(['status' => 'success', 'id' => $data['id']],
                JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            error_log($e);
            die(
            json_encode(['status' => 'error', 'message' => 'Failed to delete record'], JSON_UNESCAPED_UNICODE)
            );
        }
    }
}
