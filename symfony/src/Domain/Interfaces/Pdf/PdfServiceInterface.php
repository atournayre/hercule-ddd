<?php

namespace App\Domain\Interfaces\Pdf;

interface PdfServiceInterface
{
    /**
     * @param EntitePdfInterface $entitePdfInterface
     * @return array
     */
    public function getDonneesPourPdf(EntitePdfInterface $entitePdfInterface): array;
}
