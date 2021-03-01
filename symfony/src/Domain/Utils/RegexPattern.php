<?php

namespace App\Domain\Utils;

class RegexPattern
{
    const EMAIL = '/^.+\@\S+\.\S+$/';

    const ABREVIATION_VALIDATION = '/^[A-ZA-Z0-9]{3}$/';
}
