<?php

namespace User\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class WrongCredentialsException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            'Invalid email or password.',
            ResponseAlias::HTTP_UNAUTHORIZED);
    }
}
