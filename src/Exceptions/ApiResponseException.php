<?php

namespace ElfSundae\Laravel\Api\Exceptions;

use RuntimeException;
use ElfSundae\Laravel\Api\ApiResponse;

class ApiResponseException extends RuntimeException
{
    /**
     * The underlying response instance.
     *
     * @var \ElfSundae\Laravel\Api\ApiResponse
     */
    protected $response;

    /**
     * Create a new exception instance.
     *
     * @param  mixed  $data
     * @param  int  $code
     * @param  array  $headers
     * @param  int  $options
     */
    public function __construct($data = null, $code = -1, $headers = [], $options = 0)
    {
        $this->response = new ApiResponse($data, $code, $headers, $options);
    }

    /**
     * Thrown when the user input is invalid.
     *
     * @param  mixed  $data
     * @param  int  $code
     * @param  array  $headers
     * @param  int  $options
     * @return static
     */
    public static function invalidInputException($data = 'Invalid Input', $code = 421, $headers = [], $options = 0)
    {
        return new static($data, $code, $headers, $options);
    }

    /**
     * Thrown when action failed.
     *
     * @param  mixed  $data
     * @param  int  $code
     * @param  array  $headers
     * @param  int  $options
     * @return static
     */
    public static function actionFailureException($data = 'Action Failure', $code = 470, $headers = [], $options = 0)
    {
        return new static($data, $code, $headers, $options);
    }

    /**
     * Get the underlying response instance.
     *
     * @return \ElfSundae\Laravel\Api\ApiResponse
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return $this->getResponse();
    }
}
