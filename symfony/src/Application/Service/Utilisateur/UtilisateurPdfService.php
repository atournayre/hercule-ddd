<?php


namespace App\Application\Service\Utilisateur;


use App\Domain\Entity\Utilisateur\Utilisateur;

class UtilisateurPdfService implements \App\Domain\Interfaces\Utilisateur\UtilisateurPdfInterface
{

    public function genererPdf(Utilisateur $utilisateur): string
    {
        return __METHOD__;
    }
}