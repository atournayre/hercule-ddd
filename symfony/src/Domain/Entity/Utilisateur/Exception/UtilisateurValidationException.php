<?php

namespace App\Domain\Entity\Utilisateur\Exception;

use Exception;
use Throwable;

class UtilisateurValidationException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = sprintf('Une erreur est survenue lors de la validation des données de l\'utilisateur. %s', $message);
    }
}
