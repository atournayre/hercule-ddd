<?php

namespace App\Domain\Service;

class MajusculeService
{
    public function convertir(string $chaineAConvertir): string
    {
        return mb_strtoupper($chaineAConvertir);
    }
}