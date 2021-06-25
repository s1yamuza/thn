<?php

namespace THN\Backoffice\Hotel\Application\Exception;

use Exception;
use Throwable;

class ParamsNotValidException extends Exception
{
    protected $httpStatusCode = 400;

    public function __construct($message = "Bad request", Throwable $previous = null)
    {
        parent::__construct($message, $this->httpStatusCode, $previous);
    }
}
