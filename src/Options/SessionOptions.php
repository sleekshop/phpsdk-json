<?php

namespace Sleekshop\Options;

class SessionOptions
{
    public string $storageMethod;
    public string $cookiePath;

    /**
     * Class constructor.
     *
     * @param string $storageMethod Method of storage to be used, default is 'cookie'.
     * @param string $cookiePath Path for the cookie, default is '/'.
     * @return void
     */
    public function __construct(string $storageMethod = 'cookie', string $cookiePath = '/')
    {
        $this->storageMethod = $storageMethod;
        $this->cookiePath = $cookiePath;
    }
}