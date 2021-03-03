<?php

namespace App\Domain\Exception;

use Throwable;

class ServiceNotFoundException extends \Exception
{
    public function __construct(string $methode, string $service, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = sprintf('La méthode "%s" requiert un service non existant "%s".', $methode, $service);
    }
}
