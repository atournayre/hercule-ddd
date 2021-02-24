<?php

namespace App\Domain\Entity\Utilisateur\Exception;

use Exception;

class UtilisateurEmailInvalideException extends Exception
{
    protected $message = 'L\'email de l\'utilisateur est invalide.';
}
