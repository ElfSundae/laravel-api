<?php

namespace ElfSundae\Laravel\Api;

class Token
{
    /**
     * The Client instance.
     *
     * @var \ElfSundae\Laravel\Api\Client
     */
    protected $client;

    /**
     * Constructor.
     *
     * @param  \ElfSundae\Laravel\Api\Client  $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get the Client instance.
     *
     * @return \ElfSundae\Laravel\Api\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set the Client instance.
     *
     * @param  \ElfSundae\Laravel\Api\Client  $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Generate an api token.
     *
     * @param  string  $key
     * @param  string  $secret
     * @param  string|int  $time
     * @return string
     */
    public function generate($key, $secret, $time)
    {
        return substr(md5($key.$secret.$time), 10, 20);
    }

    /**
     * Generate an api token for the given app key.
     *
     * @param  string  $key
     * @param  string|int  $time
     * @return string|null
     */
    public function generateForKey($key, $time)
    {
        if ($secret = $this->client->getAppSecretForKey($key)) {
            return $this->generate($key, $secret, $time);
        }
    }

    /**
     * Verify an api token.
     *
     * @param  string  $token
     * @param  string  $key
     * @param  string|int  $time
     * @return bool
     */
    public function verify($token, $key, $time)
    {
        return $token && $key && $time && $token === $this->generateForKey($key, $time);
    }

    /**
     * Generate a token data array.
     *
     * @param  string  $key
     * @param  string  $secret
     * @param  string|int|null  $time
     * @return array
     */
    public function generateData($key, $secret, $time = null)
    {
        return [
            'key' => (string) $key,
            'time' => $time = $time ?: time(),
            'token' => $this->generate($key, $secret, $time),
        ];
    }

    /**
     * Generate a token data array.
     *
     * @param  string  $key
     * @param  string|int|null  $time
     * @return array
     */
    public function generateDataForKey($key, $time = null)
    {
        if ($secret = $this->client->getAppSecretForKey($key)) {
            return $this->generateData($key, $secret, $time);
        }
    }
}
