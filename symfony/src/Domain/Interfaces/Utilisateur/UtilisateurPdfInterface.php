<?php

namespace App\Domain\Interfaces\Utilisateur;

use App\Domain\Entity\Utilisateur\Utilisateur;

interface UtilisateurPdfInterface
{
    public function genererPdf(Utilisateur $utilisateur): string;
}
