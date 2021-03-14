<?php

namespace App\Domain\Interfaces\Pdf;

interface GenererPdfServiceInterface
{
    public function genererPdf(EntitePdfInterface $entitePdf): string;
}
