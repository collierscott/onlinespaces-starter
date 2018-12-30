<?php

namespace App\Exception;

use \Throwable;

class MenuNotFoundException extends \Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $message = "",
        int $code = 0,
        Throwable $previous = null
    ) {
        if(empty($message)) {
            $message = 'The menu was not found.';
        }
        parent::__construct(
            $message,
            $code,
            $previous
        );
    }
}