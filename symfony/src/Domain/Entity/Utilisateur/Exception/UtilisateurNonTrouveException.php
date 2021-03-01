<?php

namespace App\Domain\Entity\Utilisateur\Exception;

use Exception;

class UtilisateurNonTrouveException extends Exception
{
    protected $message = 'Aucun utilisateur.';
}
