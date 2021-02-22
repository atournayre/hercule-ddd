<?php

namespace App\Domain\Entity\Utilisateur\Exception;

use Exception;
use Throwable;

class UtilisateurEmailExisteException extends Exception
{
    public function __construct($email, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = sprintf('L\'email %s est déjà utilisé.', $email);
    }
}