<?php

namespace App\Domain\Interfaces\Pdf;

interface PdfServiceInterface
{
    /**
     * @param object $object
     * @return array
     */
    public function getDonneesPourPdf($object): array;
}
