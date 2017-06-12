<?php

namespace ElfSundae\Laravel\Api\Http;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class ApiResponse extends JsonResponse
{
    /**
     * The api result code.
     *
     * @var int
     */
    protected $code;

    /**
     * Create an ApiResponse instance.
     *
     * @param  mixed  $data
     * @param  int|null  $code
     * @param  array  $headers
     * @param  int  $options
     */
    public function __construct($data = null, $code = null, $headers = [], $options = 0)
    {
        $this->code = is_null($code) ? static::successCode() : (int) $code;

        parent::__construct($data, 200, $headers, $options);
    }

    /**
     * Get the code key.
     *
     * @return string
     */
    public static function codeKey()
    {
        static $codeKey = null;

        if (is_null($codeKey)) {
            $codeKey = config('api.response.key.code', 'code');
        }

        return $codeKey;
    }

    /**
     * Get the message key.
     *
     * @return string
     */
    public static function messageKey()
    {
        static $messageKey = null;

        if (is_null($messageKey)) {
            $messageKey = config('api.response.key.message', 'msg');
        }

        return $messageKey;
    }

    /**
     * Get the success code.
     *
     * @return int
     */
    public static function successCode()
    {
        static $successCode = null;

        if (is_null($successCode)) {
            $successCode = (int) config('api.response.code.success', 1);
        }

        return $successCode;
    }

    /**
     * Sets the data to be sent as JSON.
     *
     * @param  mixed  $data
     * @return $this
     */
    public function setData($data = null)
    {
        if ($data instanceof Model) {
            $data = [
                snake_case(class_basename($data)) => $this->convertObjectToArray($data),
            ];
        } elseif (is_object($data)) {
            $data = $this->convertObjectToArray($data);
        } elseif (is_null($data)) {
            $data = [];
        } elseif (is_string($data)) {
            $data = [static::messageKey() => $data];
        } elseif (! is_array($data)) {
            $data = [static::messageKey() => json_encode($data)];
        }

        if (! array_key_exists(static::codeKey(), $data)) {
            $data[static::codeKey()] = $this->getCode();
        }

        return parent::setData($data);
    }

    /**
     * Convert an object to array.
     *
     * @param  mixed  $object
     * @return array
     */
    protected function convertObjectToArray($object)
    {
        if (method_exists($object, 'toArray')) {
            return $object->toArray();
        }

        return json_decode(json_encode($object, true), true);
    }

    /**
     * Merge new data into the current data.
     *
     * @param  array  ...$data
     * @return $this
     */
    public function mergeData(array ...$data)
    {
        return $this->setData(array_replace($this->getData(true), ...$data));
    }

    /**
     * Remove empty elements from the current data.
     *
     * @return $this
     */
    public function removeEmpty()
    {
        return $this->setData(array_filter($this->getData(true)));
    }

    /**
     * Get the api result code.
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the api result code.
     *
     * @param  int  $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = (int) $code;

        return $this->mergeData([static::codeKey() => $this->code]);
    }

    /**
     * Set the api result code.
     *
     * @param  int  $code
     * @return $this
     */
    public function code($code)
    {
        return $this->setCode($code);
    }

    /**
     * Get the api result message.
     *
     * @return string
     */
    public function getMessage()
    {
        return array_get($this->getData(true), static::messageKey());
    }

    /**
     * Set the api result message.
     *
     * @param  string  $message
     * @return $this
     */
    public function setMessage($message)
    {
        return $this->mergeData([static::messageKey() => (string) $message]);
    }

    /**
     * Set the api result message.
     *
     * @param  string  $message
     * @return $this
     */
    public function message($message)
    {
        return $this->setMessage($message);
    }

    /**
     * Set the response status code.
     *
     * @param  int  $code
     * @param  mixed  $text
     * @return $this
     */
    public function statusCode($code, $text = null)
    {
        return $this->setStatusCode($code, $text);
    }
}
