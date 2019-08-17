<?php

namespace App\Exceptions;

/**
 * This class handles API authentication exceptions.
 *
 * Class ApiAuthenticationException
 */
class ApiAuthenticationException extends ApiException
{
    /**
     * Status code for the response.
     *
     * @var int
     */
    protected $statusCode = 401;

    /**
     * Create a new API exception.
     *
     * @param string $message
     *
     * @return void
     */
    public function __construct($message, $guards, $authAttempted = false)
    {
        if ($authAttempted) {
            $this->statusCode = 400;
            $this->code = self::ERR_AUTH_ATTEMPT_INCORRECT;
        } else {
            $this->code = self::ERR_AUTH_TOKEN;
        }
        parent::__construct($message, $guards);
    }
}
