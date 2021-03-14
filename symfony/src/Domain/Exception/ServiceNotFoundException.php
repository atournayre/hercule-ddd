<?php

namespace App\Domain\Exception;

use Exception;
use Throwable;

class ServiceNotFoundException extends Exception
{
    public function __construct(string $service, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = sprintf('Le service "%s" n\'existe pas.', $service);
    }
}
