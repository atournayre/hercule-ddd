<?php

namespace App\Domain\Interfaces\Pdf;

interface PdfGeneratorInterface
{
    public function genererPdf(): string;
}
