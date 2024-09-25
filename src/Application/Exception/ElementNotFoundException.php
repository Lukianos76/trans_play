<?php

namespace App\Application\Exception;

use Exception;

class ElementNotFoundException extends Exception
{
    public function __construct(string $element)
    {
        parent::__construct(sprintf('%s not found', $element));
    }
}
