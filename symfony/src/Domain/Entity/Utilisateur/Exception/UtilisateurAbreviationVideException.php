<?php

namespace App\Domain\Entity\Utilisateur\Exception;

use Exception;

class UtilisateurAbreviationVideException extends Exception
{
    protected $message = 'L\'abreviation ne peut être vide';
}