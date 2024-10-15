<?php

namespace Sleekshop\Controller;

use Sleekshop\SleekShopRequest;

class SessionCtl
{
    private SleekShopRequest $request;

    public function __construct(SleekShopRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Delivers a valid session and returns it
     *
     * @return string
     */
    public function GetSession(): string
    {
        if (!isset($_COOKIE[$this->request->token . '_session']) || $_COOKIE[$this->request->token . '_session'] == '') {
            $json = $this->request->get_new_session();
            $json = json_decode($json);
            if (isset($json->code)) {
                $code = (string)$json->code;
                self::SetSession($code);
            } else {
                throw new Exception('API ERROR // Error getting session');
            }
        } else {
            $code = $_COOKIE[$this->request->token . '_session'];
        }
        return ($code);
    }

    /**
     * Sets the session into the cookie
     *
     * @param string $session
     * @return void
     */
    public function SetSession(string $session = ''): void
    {
        setcookie($this->request->token . '_session', $session);
    }


}