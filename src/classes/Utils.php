<?php

// Make sure we don't directly access the file
if (!defined("IS_SECURE") || !IS_SECURE)
    die('I don\'t like you');

/**
 * @module Utils
 */

/**
 * Défini les méthodes d'aide commune à toutes les classes
 * @class Utils
 * @static
 * @namespace Utils
 */
class Utils {

    public static function patchJson($somethingToEncode) {
        if (version_compare(PHP_VERSION, '5.4.0', '>=') || !is_object($somethingToEncode)) {
            if (is_array($somethingToEncode) && count($somethingToEncode) > 0 && is_object($somethingToEncode[0])) {
                return self::patchJsonArray($somethingToEncode);
            } else {
                return $somethingToEncode;
            }
        } else {
            return $somethingToEncode->jsonSerialize();
        }
    }

    public static function getJsonInput($asArray = true) {
        $post = file('php://input');

        return json_decode($post[0], $asArray);
    }
    
    public static function parseGetParam() {
        $qString = $_SERVER['QUERY_STRING'];
        $args = array();
        
        parse_str($qString, $args);
        
        return $args;
    }

    protected static function patchJsonArray($arrayToEncode) {
        $newArray = array();

        foreach ($arrayToEncode as $item) {
            array_push($newArray, self::patchJson($item));
        }

        return $newArray;
    }

}
