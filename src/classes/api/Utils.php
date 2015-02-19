<?php

namespace API;

// Make sure we don't directly access the file
if (!defined("IS_SECURE") || !IS_SECURE)
    die('I don\'t like you');

/*
 * @license PASC Client - Fives
 * Available via the MIT or new BSD license.
 */

/**
 * @module API
 */

/**
 * Regroupe les webservices relatifs aux fonctions utilitaires
 * @class Utils
 * @static
 * @namespace API
 */
class Utils {
    public static function recordExists() {
        $args = \Utils::parseGetParam();
        
        $result = \Logics\Utils::recordExists($args['type'], array_diff_key($args, array('type' => '', '__route__' => '')));
        
        if ($result->isValid()) {
            return \Utils::patchJson(new Wrapper('exist', $result->getData()));
        } else {
            return array('exist' => false);
        }
    }
}