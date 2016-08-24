<?php

namespace Rainy;

class Helper {

    public static function dump($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";

        return true;
    }

    public static function debug($data)
    {
        self::dump($data);
        die;
    }

}