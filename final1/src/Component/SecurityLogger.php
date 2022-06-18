<?php

namespace App\Component;

class SecurityLogger
{
    public static function log(string $message): void
    {
        $content = file_get_contents('../security.log');

        $content .= $message . PHP_EOL;
        file_put_contents('../security.log', $content);
    }
}
