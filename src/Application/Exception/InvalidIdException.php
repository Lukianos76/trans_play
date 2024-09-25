<?php

namespace App\Application\Exception;

use Exception;

class InvalidIdException extends Exception
{
    public function __construct(string $element)
    {
        parent::__construct(sprintf('Invalid %s id', $element));
    }
}
