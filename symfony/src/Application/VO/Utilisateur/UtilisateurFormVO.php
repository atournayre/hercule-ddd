<?php

namespace App\Application\VO\Utilisateur;

use App\Domain\Entity\Utilisateur\Utilisateur;

class UtilisateurFormVO
{
    public $nom;
    public $prenom;
    public $email;
    public $abreviation;

    public function __construct(Utilisateur $utilisateur)
    {
        $this->nom = $utilisateur->getNom();
        $this->prenom = $utilisateur->getPrenom();
        $this->email = $utilisateur->getEmail();
        $this->abreviation = $utilisateur->getAbreviation();
    }
}
