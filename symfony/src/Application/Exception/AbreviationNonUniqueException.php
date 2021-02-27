<?php

namespace App\Application\Exception;

use Exception;
use Throwable;

class AbreviationNonUniqueException extends Exception
{
    const EXCEPTION_MESSAGE_PATTERN = 'L\'abréviation "%s" est déjà utilisée.';

    public function __construct(?string $abreviation = null, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = sprintf(self::EXCEPTION_MESSAGE_PATTERN, $abreviation);
    }
}
