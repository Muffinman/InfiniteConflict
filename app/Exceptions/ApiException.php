<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;

/**
 * This class handles API exceptions and error codes
 *
 * Format for error codes is as follows:
 *
 *   401xx - for 401 'Unauthorised' errors
 *   403xx - for 403 'Permission Denied' errors
 *   400xx - for 400 'Bad data' errors
 *
 * Class ApiException
 * @package App\Exceptions
 */
class ApiException extends Exception
{

    /**
     * All of the guards that were checked.
     *
     * @var array
     */
    protected $guards;

    /**
     * Error data given by the exception
     *
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * Status code for the response
     *
     * @var int
     */
    protected $statusCode = 500;

    /**
     * Bad authentication data - Method requires authentication but it was not presented or was wholly invalid.
     *
     * @var int
     */
    const ERR_AUTH_TOKEN = 40101;

    /**
     * Bad authentication data - user details given were incorrect
     *
     * @var int
     */
    const ERR_AUTH_ATTEMPT_INCORRECT = 40102;

    /**
     * Account not allowed to access this endpoint
     *
     * @var int
     */
    const ERR_AUTH_ACCESS_ENDPOINT = 40102;

    /**
     * Account not allowed due to suspension
     *
     * @var int
     */
    const ERR_AUTH_ACCESS_SUSPENDED = 40302;

    /**
     * Request method not available for this endpoint
     *
     * @var int
     */
    const ERR_ENDPOINT_NOT_FOUND = 40401;

    /**
     * Endpoint not found
     *
     * @var int
     */
    const ERR_METHOD_NOT_ALLOWED = 40501;

    /**
     * Date is not in ISO 8601 standard
     *
     * @var int
     */
    const ERR_DATA_DATE_FORMAT = 40005;

    /**
     * Bad data
     * @var int
     */
    const ERR_BAD_DATA = 40001;

    /**
     * API Rate limit exception
     * @var int
     */
    const ERR_RATE_LIMIT = 50001;

    /**
     * Create a new API exception.
     *
     * @param  string  $message
     * @param array|null $guards
     * @return void
     */
    public function __construct($message, $guards = null)
    {
        if ($guards) {
            $this->guards = $guards;
        }
        parent::__construct($message);
    }

    /**
     * Get the status code of the exception
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }


    /**
     * Get the status code of the exception
     *
     * @return \Illuminate\Support\MessageBag;
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Render the exception method
     *
     * @return JsonResponse
     */
    public function render()
    {
        return response()->json([
            'message' => $this->getMessage(),
            'errors' => $this->errors,
            'code' => $this->getCode(),
        ]);
    }
}
