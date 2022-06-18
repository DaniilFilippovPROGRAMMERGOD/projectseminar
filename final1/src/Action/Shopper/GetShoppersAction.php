<?php

namespace App\Action\Shopper;

use App\Action\AbstractAction;
use App\Repository;
use Throwable;

class GetShoppersAction extends AbstractAction
{
    public function handle(): void
    {
        header('Content-type: application/json');

        try {
            $this->repository = new Repository();
            echo json_encode($this->repository->getAllshoppers(), JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            error_log($e);
            die('[]');
        }
    }
}
