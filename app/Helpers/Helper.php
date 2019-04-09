<?php

namespace App\Helpers;

class Helper
{
    public function getServerHost(): string
    {
        $host = $_SERVER['SERVER_PORT'] === '8080' ? 'http://' : 'https://';

        return $host . $_SERVER['HTTP_HOST'];
    }
}
