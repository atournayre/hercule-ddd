<?php

namespace App\Application\Exception;

use Exception;
use Throwable;

class EmailNonUniqueException extends Exception
{
    const EXCEPTION_MESSAGE_PATTERN = 'L\'email "%s" est déjà utilisé.';

    public function __construct(?string $email = null, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = sprintf(self::EXCEPTION_MESSAGE_PATTERN, $email);
    }
}
