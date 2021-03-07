<?php

namespace App\Domain\Entity\Utilisateur\Exception;

use Exception;

class UtilisateurNonTrouveException extends Exception implements UtilisateurNonTrouveExceptionInterface
{
    protected $message = 'Aucun utilisateur.';
}
