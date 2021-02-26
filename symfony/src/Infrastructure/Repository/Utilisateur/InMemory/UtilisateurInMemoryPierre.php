<?php

namespace App\Infrastructure\Repository\Utilisateur\InMemory;

use App\Domain\Entity\Utilisateur\Utilisateur;

class UtilisateurInMemoryPierre extends Utilisateur
{
    const ID = 1;
    const EMAIL = 'pierre@email.com';
    const NOM = 'PAPIER';
    const PRENOM = 'Pierre';
    const ABREVIATION = 'PAP';

    public function __construct()
    {
        $this->id = self::ID;
        $this->email = self::EMAIL;
        $this->nom = self::NOM;
        $this->prenom = self::PRENOM;
        $this->abreviation = self::ABREVIATION;
    }
}