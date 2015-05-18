<?php

/**
 * Created by PhpStorm.
 * User: fsoul
 * Date: 14.05.2015
 * Time: 19:43
 */
class VHelper
{
    const TYPE_JPG = 'jpg';

    public static function getRandomFileName($path, $extension = '')
    {
        $extension = $extension ? '.' . $extension : '.' . self::TYPE_JPG;
        $path = $path ? $path . '/' : '';

        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name . $extension;
        } while (file_exists($file));

        return $name;
    }

    public static function dump($str, $die = null)
    {
        echo '<pre>';
        print_r($str);
        echo '</pre>';
        if ($die != null) {
            die('DIE');
        }
    }
}