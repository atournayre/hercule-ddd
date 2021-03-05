<?php

namespace App\Application\Service\Utilisateur;

use App\Domain\Entity\Utilisateur\Utilisateur;
use App\Domain\Interfaces\Pdf\PdfServiceInterface;

class UtilisateurPdfService implements PdfServiceInterface
{
    /**
     * @param Utilisateur|object $utilisateur
     * @return array
     */
    public function getDonneesPourPdf($utilisateur): array
    {
        return [
            'test' => 'test',
        ];
    }
}
