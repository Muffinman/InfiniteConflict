<?php
namespace App\Exceptions;

use Illuminate\Support\MessageBag;

/**
 * This class handles API authentication exceptions
 *
 * Class ApiRateLimitException
 * @package App\Exceptions
 */
class ApiRateLimitException extends ApiException
{

    /**
     * Status code for the response
     *
     * @var int
     */
    protected $statusCode = 500;

    /**
     * Create a new API exception.
     *
     * @param  string  $message
     * @return void
     */
    public function __construct($message)
    {
        $this->code = self::ERR_RATE_LIMIT;

        parent::__construct($message);
    }
}
