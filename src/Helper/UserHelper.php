<?php

namespace Sleekshop\Helper;

use Sleekshop\SleekshopRequest;

class UserHelper
{

    public static function convert_user_response(array $json): array
    {
        $result = [];
        $result['id_user'] = (int)$json['id_user'];
        $result['session_id'] = (string)$json['session_id'];
        $result['username'] = (string)$json['username'];
        $result['email'] = (string)$json['email'];
        $result['salutation'] = (string)$json['attributes']['salutation']['value'];
        $result['firstname'] = (string)$json['attributes']['firstname']['value'];
        $result['lastname'] = (string)$json['attributes']['lastname']['value'];
        $result['companyname'] = (string)$json['attributes']['companyname']['value'];
        $result['department'] = (string)$json['attributes']['department']['value'];
        $result['street'] = (string)$json['attributes']['street']['value'];
        $result['number'] = (string)$json['attributes']['number']['value'];
        $result['zip'] = (string)$json['attributes']['zip']['value'];
        $result['city'] = (string)$json['attributes']['city']['value'];
        $result['state'] = (string)$json['attributes']['state']['value'];
        $result['country'] = (string)$json['attributes']['country']['value'];
        foreach ($json['additional_attributes'] as $attribute) {
            $name = (string)$attribute['name'];
            $result[$name] = $attribute['value'];
        }

        return $result;
    }

}