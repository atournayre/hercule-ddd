<?php

namespace App\Domain\Exception;

use Exception;
use Throwable;

class ChampInvalideException extends Exception
{
    public function __construct(?string $champ, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = sprintf('Le champ "%s" est invalide.', $champ);
    }
}