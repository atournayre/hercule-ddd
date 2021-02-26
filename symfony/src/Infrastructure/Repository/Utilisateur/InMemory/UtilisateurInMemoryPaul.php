<?php

namespace App\Infrastructure\Repository\Utilisateur\InMemory;

use App\Domain\Entity\Utilisateur\Utilisateur;

class UtilisateurInMemoryPaul extends Utilisateur
{
    const ID = 2;
    const EMAIL = 'paul@email.com';
    const NOM = 'JACQUES';
    const PRENOM = 'Paul';
    const ABREVIATION = 'JAP';

    public function __construct()
    {
        $this->id = self::ID;
        $this->email = self::EMAIL;
        $this->nom = self::NOM;
        $this->prenom = self::PRENOM;
        $this->abreviation = self::ABREVIATION;
    }
}