<?php

namespace App\Domain\Entity\Utilisateur\Exception;

use Exception;

class UtilisateurPrenomInvalideException extends Exception
{
    protected $message = 'Le prénom de l\'utilisateur est invalide.';
}
