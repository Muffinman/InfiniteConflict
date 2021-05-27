<?php

namespace App\Exceptions;

/**
 * This class handles API authentication exceptions.
 *
 * Class ApiMethodNotAllowedHttpException
 */
class ApiAccessDeniedException extends ApiException
{
    /**
     * Status code for the response.
     *
     * @var int
     */
    protected $statusCode = 403;

    /**
     * Create a new API exception.
     *
     * @return void
     */
    public function __construct($message = 'Access Denied')
    {
        $this->code = self::ERR_AUTH_ACCESS_ENDPOINT;
        parent::__construct($message);
    }
}
