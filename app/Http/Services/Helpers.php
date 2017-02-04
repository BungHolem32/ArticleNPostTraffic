<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 03/02/17
 * Time: 20:21
 */

namespace App\Http\Service;


class Helpers
{
    public function random_string($length)
    {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }
}