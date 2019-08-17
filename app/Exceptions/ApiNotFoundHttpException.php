<?php
namespace App\Exceptions;

/**
 * This class handles API 404 exceptions
 *
 * Class ApiNotFoundHttpException
 * @package App\Exceptions
 */
class ApiNotFoundHttpException extends ApiException
{

    /**
     * Status code for the response
     *
     * @var int
     */
    protected $statusCode = 404;

    /**
     * Create a new API exception.
     *
     * @param  string  $message
     * @return void
     */
    public function __construct($message)
    {
        $this->code = self::ERR_ENDPOINT_NOT_FOUND;
        parent::__construct($message);
    }
}
