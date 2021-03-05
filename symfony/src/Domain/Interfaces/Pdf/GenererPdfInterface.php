<?php

namespace App\Domain\Interfaces\Pdf;

interface GenererPdfInterface
{
    /**
     * @param string $template
     * @return string
     */
    public function genererPdf(string $template): string;
}
