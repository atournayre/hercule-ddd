<?php

namespace App\Domain\Interfaces\Pdf;

interface GenererPdfServiceInterface
{
    /**
     * @param EntitePdfInterface $entitePdf
     * @return string
     */
    public function genererPdf(EntitePdfInterface $entitePdf): string;
}
