<?php

namespace Sleekshop\Controller;

use Sleekshop\SleekshopRequest;
use Sleekshop\Options\SessionOptions;

class SessionCtl
{
    private SleekshopRequest $request;

    public function __construct(SleekshopRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Returns a valid session code
     *
     * @param SessionOptions|null $options Options for session retrieval and storage
     * @return string
     * @throws \Exception
     */
    public function GetSession(SessionOptions $options = null): string
    {
        $options = $options ?? new SessionOptions();

        $sessionCode = $this->retrieveSession($options->storageMethod);
        if ($sessionCode === null) {
            $sessionCode = $this->fetchSession();
            $this->storeSession($sessionCode, $options->storageMethod, $options->cookiePath);
        }
        return $sessionCode;
    }

    /**
     * Invalidates the current session locally
     *
     * @param SessionOptions|null $options
     * @return void
     */
    public function InvalidateSession(SessionOptions $options = null): void
    {
        $options = $options ?? new SessionOptions();
        switch ($options->storageMethod) {
            case 'cookie':
                setcookie($this->request->token . '_session', '', [
                    'path' => $options->cookiePath
                ]);
                break;
            case 'session':
                unset($_SESSION[$this->request->token . '_session']);
                break;
            case 'none':
                // Do nothing, user handles storage themselves
                break;
            default:
                throw new \InvalidArgumentException('Unsupported storage method');
        }
    }

    /**
     * Retrieves the session based on the storage method
     *
     * @param string $storageMethod
     * @return string|null
     */
    private function retrieveSession(string $storageMethod): ?string
    {
        return match ($storageMethod) {
            'cookie' => $_COOKIE[$this->request->token . '_session'] ?? null,
            'session' => $_SESSION[$this->request->token . '_session'] ?? null,
            'none' => null,
            default => throw new \InvalidArgumentException('Unsupported storage method'),
        };
    }

    /**
     * Fetches a new session from the API
     *
     * @return string
     * @throws \Exception
     */
    private function fetchSession(): string
    {
        $json = $this->request->get_new_session();
        if ($json['status'] == 'error') {
            throw new \Exception('API ERROR // Error getting session');
        }

        return (string)$json['response']['code'];
    }

    /**
     * Stores the session based on the storage method
     *
     * @param string $sessionCode
     * @param string $storageMethod
     * @param string $cookiePath
     * @return void
     */
    private function storeSession(string $sessionCode, string $storageMethod, string $cookiePath): void
    {
        switch ($storageMethod) {
            case 'cookie':
                setcookie($this->request->token . '_session', $sessionCode, [
                    'path' => $cookiePath
                ]);
                break;
            case 'session':
                $_SESSION[$this->request->token . '_session'] = $sessionCode;
                break;
            case 'none':
                // Do nothing, user handles storage themselves
                break;
            default:
                throw new \InvalidArgumentException('Unsupported storage method');
        }
    }
}