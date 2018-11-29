<?php

namespace App\Exception;

class AccountDisabledException extends \Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(
        string $message = "",
        int $code = 0,
        \Throwable $previous = null
    ) {
        if(empty($message)) {
            $message = 'Account has been disabled.';
        }
        parent::__construct(
            $message,
            $code,
            $previous
        );
    }
}