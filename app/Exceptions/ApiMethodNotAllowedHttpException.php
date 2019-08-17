<?php

namespace App\Exceptions;

/**
 * This class handles API authentication exceptions.
 *
 * Class ApiMethodNotAllowedHttpException
 */
class ApiMethodNotAllowedHttpException extends ApiException
{
    /**
     * Status code for the response.
     *
     * @var int
     */
    protected $statusCode = 405;

    /**
     * Create a new API exception.
     *
     * @param string $message
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->code = self::ERR_METHOD_NOT_ALLOWED;
        parent::__construct($message);
    }
}
