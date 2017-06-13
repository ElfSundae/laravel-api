<?php

namespace ElfSundae\Laravel\Api\Exceptions;

class InvalidInputException extends ApiResponseException
{
    /**
     * Create a new exception instance.
     *
     * @param  mixed  $data
     * @param  int  $code
     * @param  array  $headers
     * @param  int  $options
     * @return void
     */
    public function __construct($data = 'Invalid Input', $code = 421, $headers = [], $options = 0)
    {
        parent::__construct($data, $code, $headers, $options);
    }
}
