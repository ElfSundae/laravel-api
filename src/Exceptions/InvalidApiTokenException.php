<?php

namespace ElfSundae\Laravel\Api\Exceptions;

class InvalidApiTokenException extends ApiResponseException
{
    /**
     * Create a new exception instance.
     *
     * @param  mixed  $data
     * @param  int  $code
     * @param  array  $headers
     * @param  int  $options
     */
    public function __construct($data = 'Invalid Api Token', $code = 403, $headers = [], $options = 0)
    {
        parent::__construct($data, $code, $headers, $options);
    }
}
