<?php

namespace Sleekshop\Controller;

use Sleekshop\Helper\UserHelper;
use Sleekshop\SleekShopRequest;

class UserCtl
{

    private SleekShopRequest $request;

    public function __construct(SleekShopRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Registers a new user
     *
     * @param array $args [ 'username' => '', 'passwd1' => '', 'passwd2' => '', 'email' => '', 'class' => null, ]
     * @param string|null $lang
     * @return array
     */
    public function RegisterUser(
        array  $args = [
            'username' => '',
            'passwd1' => '',
            'passwd2' => '',
            'email' => '',
            'class' => null,
        ],
        string $lang = null
    ): array
    {
        $json = $this->request->register_user($args, $lang);
        if ($json['status'] == 'error') {
            return $json;
        }

        $result = [];
        $result['status'] = (string)$json['status'];
        $result['id_user'] = (int)$json['id_user'];
        $result['session_id'] = (string)$json['session_id'];
        $json['response'] = $result;

        return $json;
    }

    /**
     * Verifies the user
     *
     * @param int $id_user
     * @param string $session_id
     * @return array
     */
    public function VerifyUser(int $id_user = 0, string $session_id = ''): array
    {
        $json = $this->request->verify_user($id_user, $session_id);
        if ($json['status'] == 'error') {
            return $json;
        }

        $result = [];
        $result['status'] = (string)$json['status'];
        $json['response'] = $result;

        return $json;
    }

    /**
     * Logs in the user
     *
     * @param string $session
     * @param string $username
     * @param string $password
     * @return array
     */
    public function Login(string $session = '', string $username = '', string $password = ''): array
    {
        $json = $this->request->login_user($session, $username, $password);
        if ($json['status'] == 'error') {
            return $json;
        }

        $result = [];
        $result['status'] = (string)$json['status'];
        $result['id_user'] = (int)$json['id_user'];
        $result['session_id'] = (string)$json['session_id'];
        $result['username'] = (string)$json['username'];
        $result['email'] = (string)$json['email'];
        $json['response'] = $result;

        return $json;
    }


    /**
     * This function allows you to log out a user from their current session
     *
     * @param string $session
     * @return array
     */
    public function LogOut(string $session = ''): array
    {
        $json = $this->request->logout_user($session);
        if ($json['status'] == 'error') {
            return $json;
        }

        $result['status'] = (string)$json['status'];
        $json['response'] = $result;

        return $json;
    }

    /**
     * This function allows you to change the password of a user
     *
     * @param string $session
     * @param string $passwd1
     * @param string $passwd2
     * @param string $passwd3
     * @return array
     */
    public function SetUserPassword(string $session = '', string $passwd1 = '', string $passwd2 = '', string $passwd3 = ''): array
    {
        $json = $this->request->set_user_password($session, $passwd1, $passwd2, $passwd3);
        if ($json['status'] == 'error') {
            return $json;
        }

        $result = [];
        $result['status'] = (string)$json['status'];
        $json['response'] = $result;

        return $json;
    }

    /**
     * This function allows you to reset the password of a user
     *
     * @param array $args
     * @return array
     */
    public function ResetUserPassword(array $args = []): array
    {
        return $this->request->reset_user_password($args);
    }

    /**
     * This function allows you to retrieve all orders for a logged-in user in the provided session
     *
     * @param string $session
     * @return array
     */
    public function GetUserOrders(string $session = ''): array
    {
        $json = $this->request->get_user_orders($session);
        if ($json['status'] == 'error') {
            return $json;
        }

        $result = [];
        foreach ($json['response']['orders'] as $order) {
            $pieceArray = array();
            $pieceArray['id'] = (int)$order['id'];
            $pieceArray['order_number'] = (int)$order['order_number'];
            $pieceArray['creation_date'] = (string)$order['creation_date'];
            $pieceArray['order_email'] = (string)$order['order_email'];
            $pieceArray['payment_method'] = (string)$order['payment_method'];
            $pieceArray['payment_state_name'] = (string)$order['payment_state']['name'];
            $pieceArray['payment_state_label'] = (string)$order['payment_state']['label'];
            $pieceArray['delivery_method'] = (string)$order['delivery_method'];
            $pieceArray['delivery_state_name'] = (string)$order['delivery_state']['name'];
            $pieceArray['delivery_state_label'] = (string)$order['delivery_state']['label'];
            $pieceArray['order_state'] = (string)$order['order_state'];
            $pieceArray['cart_sum'] = (float)$order['cart']['sum'];
            $result[] = $pieceArray;
        }
        $json['response'] = $result;

        return $json;
    }

    /**
     * This function gets the user - data
     *
     * @param string $session
     * @return array
     */
    public function GetUserData(string $session = ''): array
    {
        $json = $this->request->get_user_data($session);
        if ($json['status'] == 'error') {
            return $json;
        }

        $json['response'] = UserHelper::convert_user_response($json['response']);
        return $json;
    }

    /**
     * This function gets the user - data by id
     *
     * @param int $id_user
     * @return array
     */
    public function GetUserById(int $id_user = 0): array
    {
        $json = $this->request->get_user_by_id($id_user);
        if ($json['status'] == 'error') {
            return $json;
        }

        $json['response'] = UserHelper::convert_user_response($json['response']);
        return $json;
    }

    /**
     * This function sets the user - data
     *
     * @param string $session
     * @param array $args
     * @return array
     */
    public function SetUserData(string $session = '', array $args = []): array
    {
        $json = $this->request->set_user_data($session, $args);
        if ($json['status'] == 'error') {
            return $json;
        }

        $result = [];
        $result['status'] = (string)$json['status'];
        $json['response'] = $result;

        return $json;
    }

    /**
     * This function updates the user - data by id
     *
     * @param int $id_user
     * @param array $args
     * @return array
     */
    public function UpdateUserData(int $id_user = 0, array $args = []): array
    {
        return $this->request->update_user_data($id_user, $args);
    }

    /**
     * This function allows for instant login of users from the backend into remote applications communicating with the API
     *
     * @param string $token
     * @param string $application_token
     * @return array
     */
    public function InstantLogin(string $token = '', string $application_token = ''): array
    {
        return $this->request->instant_login($token, $application_token);
    }

}