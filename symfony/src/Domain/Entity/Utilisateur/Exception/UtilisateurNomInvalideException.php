<?php

namespace App\Domain\Entity\Utilisateur\Exception;

use Exception;

class UtilisateurNomInvalideException extends Exception
{
    protected $message = 'Le nom de l\'utilisateur est invalide.';
}
