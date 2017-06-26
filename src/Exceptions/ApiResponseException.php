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
     * Get the underlying response instance.
     *
     * @return \ElfSundae\Laravel\Api\ApiResponse
     */
    public function getResponse()
    {
        return $this->response;
    }
}
