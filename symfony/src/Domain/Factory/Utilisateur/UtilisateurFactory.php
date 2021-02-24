<?php

namespace App\Domain\Factory\Utilisateur;

use App\Domain\Entity\Utilisateur\Utilisateur;

class UtilisateurFactory
{
    const MOT_DE_PASSE_INITIAL = 'mot_de_passe_a_reinitialiser';

    public function creerUnUtilisateur(
        ?string $email = null,
        ?string $nom = null,
        ?string $prenom = null,
        ?string $abreviation = null
    ): Utilisateur
    {
        return (new Utilisateur())
            ->setEmail($email)
            ->setNom($nom)
            ->setPrenom($prenom)
            ->setAbreviation($abreviation)
            ->setPassword(self::MOT_DE_PASSE_INITIAL)
            ->setRoles([Utilisateur::ROLE_PAR_DEFAUT]);
    }
}
