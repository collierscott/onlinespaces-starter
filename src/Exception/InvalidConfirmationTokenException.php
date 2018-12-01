<?php

namespace App\Exception;

use Throwable;

class InvalidConfirmationTokenException extends \Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        if(empty($message)) {
            $message = 'The confirmation token is invalid.';
        }

        parent::__construct($message, $code, $previous);
    }
}