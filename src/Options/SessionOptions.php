<?php

namespace Sleekshop\Options;

class SessionOptions
{
    public string $storageMethod;
    public string $cookiePath;

    public function __construct(string $storageMethod = 'cookie', string $cookiePath = '/')
    {
        $this->storageMethod = $storageMethod;
        $this->cookiePath = $cookiePath;
    }
}