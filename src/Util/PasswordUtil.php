<?php

declare(strict_types=1);

namespace App\Util;

class PasswordUtil
{
    private function __construct()
    {
    }

    /**
     * @param int $length
     * @return string
     *
     * @throws \Exception
     */
    public static function generatePassword(int $length = 8): string
    {
        return \bin2hex(\random_bytes($length));
    }
}
