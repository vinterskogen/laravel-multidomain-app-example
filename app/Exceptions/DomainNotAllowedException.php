<?php

namespace App\Exceptions;

use Exception;

class DomainNotAllowedException extends Exception
{
    /**
     * @param mixed $message
     */
    public function __construct($message = "Domain not allowed.")
    {
        $this->message = $message;
    }

}
