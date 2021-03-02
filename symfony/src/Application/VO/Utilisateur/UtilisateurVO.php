<?php

namespace App\Application\VO\Utilisateur;

use App\Domain\Interfaces\Utilisateur\UtilisateurValidationInterface;
use App\Domain\Utils\RegexPattern;

class UtilisateurVO implements UtilisateurValidationInterface
{
    public $email;
    public $nom;
    public $prenom;
    public $abreviation;

    public function isEmailInvalide(): bool
    {
        return empty($this->email)
            || !preg_match(RegexPattern::EMAIL, $this->email);
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
            || !preg_match(RegexPattern::ABREVIATION_VALIDATION, $this->abreviation);
    }
}
