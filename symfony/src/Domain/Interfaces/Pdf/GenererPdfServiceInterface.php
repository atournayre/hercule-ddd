<?php

namespace App\Domain\Interfaces\Pdf;

interface GenererPdfServiceInterface
{
    /**
     * @param object $object
     * @return string
     */
    public function genererPdf($object): string;
}
