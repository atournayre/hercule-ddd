<?php

namespace App\Domain\Interfaces\Pdf;

interface GenererPdfInterface
{
    /**
     * @return string
     */
    public function genererPdf(): string;
}
