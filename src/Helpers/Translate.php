<?php

namespace Ur13l\ApiCrudGenerator\Helpers;

/**
 * Trait Translate
 * @package Ur13l\ApiCrudGenerator\Helpers
 */
trait Translate {

    protected static $lang = "en";

    public static function  setLang($l)
    {
        static::$lang = $l;
    } 

    public static function trans($text) {
        $arr = static::getLangFile();
        return $arr[$text] ? $arr[$text] : $text;
    }

    public static function getLangFile() {
        return include("Resources/Lang/" . static::$lang . "/strings.php");
    }
}