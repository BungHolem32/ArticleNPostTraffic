<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 02/02/17
 * Time: 19:51
 */
namespace App\Http\Service;

use Exception;

class Curl
{

    public function PullDataFromApi($url)
    {
        if (!$url) {
            throw new Exception('You Must Pass url');
        }

        $connection = curl_init();
        curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($connection, CURLOPT_URL, $url);
        curl_setopt($connection, CURLOPT_URL, $url);
        $data = curl_exec($connection);
        return json_decode($data);
    }

}