<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  Exception  $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->expectsJson()) {
            return $this->handleApiException($request, $exception);
        } else {
            return parent::render($request, $exception);
        }
    }

    /**
     * Handle an API exception
     *
     * @param $request
     * @param Exception $exception
     * @return mixed
     */
    private function handleApiException($request, Exception $exception)
    {

        $originalException = $exception;

        // Rewrite some of the Laravel default exceptions so that we can add our own error codes
        if ($exception instanceof MethodNotAllowedHttpException) {
            $exception = new ApiMethodNotAllowedHttpException('Method not allowed for this endpoint');
        } elseif ($exception instanceof NotFoundHttpException) { // 404
            $exception = new ApiNotFoundHttpException('Endpoint not found');
        } elseif ($exception instanceof AuthenticationException) { // 403
            $exception = new ApiAuthenticationException('Unauthenticated.', $exception->guards());
        } elseif ($exception instanceof  ThrottleRequestsException) {
            $exception = new ApiRateLimitException($exception->getMessage());
        } elseif ($exception instanceof  ValidationException) {
            $exception = new ApiValidationHttpException($exception->getMessage(), $exception->validator->errors());
        }  elseif (!$exception instanceof ApiException) { // Anything else, make sure we only return ApiExceptions
            $exception = new ApiException($exception->getMessage());
        }

        $output = [
            'statusCode' => $exception->getStatusCode(),
            'message' => $exception->getMessage(),
            'data' => [
                'code' => $exception->getCode(),
                'errors' => $exception->getErrors(),
            ]
        ];

        if (config('app.debug') && $originalException) {
            $output['data']['trace'] = $originalException->getTrace();
        }

        return response()->json($output, $exception->getStatusCode());
    }
}
