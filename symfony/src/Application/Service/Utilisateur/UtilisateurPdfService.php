<?php

namespace App\Application\Service\Utilisateur;

use App\Domain\Entity\Utilisateur\Utilisateur;
use App\Domain\Interfaces\Pdf\EntitePdfInterface;
use App\Domain\Interfaces\Pdf\PdfServiceInterface;

class UtilisateurPdfService implements PdfServiceInterface
{
    /**
     * @param EntitePdfInterface|Utilisateur $utilisateur
     * @return array
     */
    public function getDonneesPourPdf(EntitePdfInterface $utilisateur): array
    {
        return [
            'nomComplet' => sprintf('%s %s', $utilisateur->getPrenom(), $utilisateur->getNom()),
            'email' => $utilisateur->getEmail(),
            'abreviation' => $utilisateur->getAbreviation(),
        ];
    }
}
