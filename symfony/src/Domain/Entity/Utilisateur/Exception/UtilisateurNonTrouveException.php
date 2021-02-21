<?php

namespace App\Domain\Entity\Utilisateur\Exception;

use Exception;
use Throwable;

class UtilisateurNonTrouveException extends Exception
{
    public function __construct($message = "Aucun utilisateur.", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}