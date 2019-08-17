<?php

namespace App\Exceptions;

use Illuminate\Support\MessageBag;

/**
 * This class handles API authentication exceptions.
 *
 * Class ApiMethodNotAllowedHttpException
 */
class ApiValidationHttpException extends ApiException
{
    /**
     * Status code for the response.
     *
     * @var int
     */
    protected $statusCode = 400;

    /**
     * Create a new API exception.
     *
     * @param string                         $message
     * @param \Illuminate\Support\MessageBag $errors;
     *
     * @return void
     */
    public function __construct($message, MessageBag $errors)
    {
        $this->code = self::ERR_BAD_DATA;

        if ($errors) {
            $this->errors = $errors;
        }

        parent::__construct($message);
    }
}
