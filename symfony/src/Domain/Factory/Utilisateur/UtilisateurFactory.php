<?php

namespace App\Domain\Factory\Utilisateur;

use App\Domain\Entity\Utilisateur\Utilisateur;

class UtilisateurFactory
{
    public function creer(string $email, string $nom, string $prenom, string $abreviation): Utilisateur
    {
        return (new Utilisateur())
            ->setEmail($email)
            ->setNom($nom)
            ->setPrenom($prenom)
            ->setAbreviation($abreviation)
            ->setPassword('mot_de_passe_a_reinitialiser')
            ->setRoles([Utilisateur::ROLE_USER]);
    }
}
