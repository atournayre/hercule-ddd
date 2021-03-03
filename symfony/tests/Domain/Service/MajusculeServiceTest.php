<?php

namespace App\Tests\Domain\Service;

use App\Domain\Service\MajusculeService;
use PHPUnit\Framework\TestCase;

class MajusculeServiceTest extends TestCase
{
    public function testMajuscule()
    {
        $majusculeService = new MajusculeService();
        $chaineAConvertir = 'œ&é"\'(-è_çà)=Œ1234567890°+“´~#{[|`\^@]}azertyuiop^$¨£qsdfghjklmù*%<wxcvbn,;:!<?./§';
        $chaineAttendue = 'Œ&É"\'(-È_ÇÀ)=Œ1234567890°+“´~#{[|`\^@]}AZERTYUIOP^$¨£QSDFGHJKLMÙ*%<WXCVBN,;:!<?./§';
        $this->assertEquals($chaineAttendue, $majusculeService->convertir($chaineAConvertir));
    }
}