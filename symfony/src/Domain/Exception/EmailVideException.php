<?php

namespace App\Domain\Exception;

use Exception;

class EmailVideException extends Exception
{
    protected $message = "L'email est vide.";
}
