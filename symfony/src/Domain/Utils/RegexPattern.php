<?php

namespace App\Domain\Utils;

class RegexPattern
{
    const EMAIL = '/^.+\@\S+\.\S+$/';

    const ABREVIATION_VALIDATION = '/^[A-Z0-9]{3}$/';
}
