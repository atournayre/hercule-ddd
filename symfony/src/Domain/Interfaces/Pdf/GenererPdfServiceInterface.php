<?php

namespace App\Domain\Interfaces\Pdf;

interface GenererPdfServiceInterface
{
    /**
     * @param string $template
     * @param object $object
     * @return string
     */
    public function genererPdf(string $template, $object): string;
}
