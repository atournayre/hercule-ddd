<?php

namespace App\Domain\Entity\Utilisateur\Exception;

use Exception;

class UtilisateurAbreviationInvalideException extends Exception
{
    protected $message = 'L\'abréviation de l\'utilisateur est invalide.';
}
