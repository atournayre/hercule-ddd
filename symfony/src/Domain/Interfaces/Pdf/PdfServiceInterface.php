<?php

namespace App\Domain\Interfaces\Pdf;

interface PdfServiceInterface
{
    public function getDonneesPourPdf(EntitePdfInterface $entitePdf): array;
}
