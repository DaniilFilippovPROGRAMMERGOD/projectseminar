<?php

namespace App\Action\Auth;

use App\Action\AbstractAction;

class LogoutAction extends AbstractAction
{
    public function handle(): void
    {
        session_regenerate_id(true);
        unset($_SESSION['is_auth']);

        session_write_close();

        header('Location: /get-products');
    }
}
