<?php

// Make sure we don't directly access the file
if (!defined("IS_SECURE") || !IS_SECURE)
    die('I don\'t like you');

/**
 * @module Utils
 */
if (!interface_exists('JsonSerializable')) {

    /**
     * Interface assurant la présence d'une fonction d'export en JSON
     * @class JsonSerializable
     * @static
     * @namespace Utils
     */
    interface JsonSerializable {

        /**
         * Appelé lors de la transformation de l'objet en JSON
         * @method jsonSerialize
         * @return {Array|String|Number}
         */
        public function jsonSerialize();
    }

}

if (!function_exists('http_response_code')) {

    // Rajoute la fonction http_response_code pour les versions de PHP ne l'ayant pas
    function http_response_code($code = NULL) {

        $textEntries = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Moved Temporarily',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Time-out',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Large',
            415 => 'Unsupported Media Type',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Time-out',
            505 => 'HTTP Version not supported'
        );

        if ($code !== NULL) {
            if (array_key_exists($code, $textEntries)) {
                $text = $textEntries[$code];
            } else {
                exit('Unknown http status code "' . htmlentities($code) . '"');
            }

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

            header($protocol . ' ' . $code . ' ' . $text);

            $GLOBALS['http_response_code'] = $code;
        } else {
            $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);
        }

        return $code;
    }

}
