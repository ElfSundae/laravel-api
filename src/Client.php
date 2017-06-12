<?php

namespace ElfSundae\Laravel\Api;

use Illuminate\Contracts\Encryption\Encrypter;

class Client
{
    /**
     * The Encrypter instance.
     *
     * @var \Illuminate\Contracts\Encryption\Encrypter
     */
    protected $encrypter;

    /**
     * The api clients.
     *
     * @var array
     */
    protected $clients = [];

    /**
     * The default app key.
     *
     * @var string
     */
    protected $defaultAppKey;

    /**
     * Constructor.
     *
     * @param  array  $clients
     */
    public function __construct(Encrypter $encrypter, array $clients = [])
    {
        $this->encrypter = $encrypter;
        $this->clients = $clients;
    }

    /**
     * Get the clients.
     *
     * @return array
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * Set the client.
     *
     * @param  array  $clients
     */
    public function setClients(array $clients)
    {
        $this->clients = $clients;
    }

    /**
     * Get the Encrypter instance.
     *
     * @return \Illuminate\Contracts\Encryption\Encrypter
     */
    public function getEncrypter()
    {
        return $this->encrypter;
    }

    /**
     * Set the Encrypter instance.
     *
     * @param  \Illuminate\Contracts\Encryption\Encrypter  $encrypter
     */
    public function setEncrypter(Encrypter $encrypter)
    {
        $this->encrypter = $encrypter;
    }

    /**
     * Get the default app key.
     *
     * @return string
     */
    public function defaultAppKey()
    {
        return $this->defaultAppKey ?: (string) array_first(array_keys($this->clients));
    }

    /**
     * Set the default app key.
     *
     * @param  string  $key
     * @return $this
     */
    public function setDefaultAppKey($key)
    {
        $this->defaultAppKey = $key;

        return $this;
    }

    /**
     * Get the app key for the given app name.
     *
     * @param  string  $appName
     * @return string
     */
    public function appKeyForName($appName)
    {
        return substr(sha1((string) $appName.$this->encrypter->getKey()), 0, 16);
    }

    /**
     * Generate an app secret for the given app key.
     *
     * @param  string  $appKey
     * @return string
     */
    public function generateAppSecretForKey($appKey)
    {
        return md5($this->encrypter->encrypt($appKey));
    }

    /**
     * Generate an app secret for the given app name.
     *
     * @param  string  $appName
     * @return string
     */
    public function generateAppSecretForName($appName)
    {
        return $this->generateAppSecretForKey($this->appKeyForName($appName));
    }

    /**
     * Get the app name for the given app key.
     *
     * @param  string  $key
     * @return string|null
     */
    public function getAppNameForKey($key)
    {
        return array_get($this->clients, $key.'.name');
    }

    /**
     * Get the app secret for the given app key.
     *
     * @param  string  $key
     * @return string|null
     */
    public function getAppSecretForKey($key)
    {
        return array_get($this->clients, $key.'.secret');
    }
}
