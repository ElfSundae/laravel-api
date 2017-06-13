<?php

namespace ElfSundae\Laravel\Api\Exceptions;

class ActionFailureException extends ApiResponseException
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
    public function __construct($data = 'Action Failure', $code = 470, $headers = [], $options = 0)
    {
        parent::__construct($data, $code, $headers, $options);
    }
}
