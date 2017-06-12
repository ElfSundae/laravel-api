<?php

namespace ElfSundae\Laravel\Api\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ElfSundae\Laravel\Api\ClientManager
 */
class ApiClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'api.client';
    }
}
