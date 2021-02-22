<?php

namespace App\Domain\Entity\Utilisateur\Exception;

use Exception;
use Throwable;

class UtilisateurAbreviationExisteException extends Exception
{
    public function __construct($abreviation, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = sprintf('L\'abreviation %s est déjà utilisée.', $abreviation);
    }
}