<?php

namespace App\Domain\Exception;

use Exception;
use Throwable;

class EmailInvalideException extends Exception
{
    public function __construct(?string $email, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = sprintf('L\'email %s est invalide.', $email);
    }
}