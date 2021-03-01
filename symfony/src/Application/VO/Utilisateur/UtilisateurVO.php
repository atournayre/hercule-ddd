<?php

namespace App\Application\VO\Utilisateur;

use App\Domain\Interfaces\Utilisateur\UtilisateurValidationInterface;

class UtilisateurVO implements UtilisateurValidationInterface
{
    const EMAIL_PATTERN = '/^.+\@\S+\.\S+$/';
    const ABREVIATION_VALIDATION_PATTERN = '/^[A-Z0-9]{3}$/';

    public $email;
    public $nom;
    public $prenom;
    public $abreviation;


    public function isEmailInvalide(): bool
    {
        return empty($this->email)
            || !preg_match(self::EMAIL_PATTERN, $this->email);
    }

    public function isNomInvalide(): bool
    {
        return empty(trim($this->nom));
    }

    public function isPrenomInvalide(): bool
    {
        return empty(trim($this->prenom));
    }

    public function isAbreviationInvalide(): bool
    {
        return empty($this->abreviation)
            || !preg_match(self::ABREVIATION_VALIDATION_PATTERN, $this->abreviation);
    }
}
