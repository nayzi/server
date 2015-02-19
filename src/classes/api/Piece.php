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
 * Regroupe les webservices relatifs aux pièces
 * @class Piece
 * @static
 * @uses API.ItemUpdatable
 * @uses API.ItemCreatable
 * @namespace API
 */
class Piece implements ItemUpdatable, ItemCreatable {
    
    // Implémentation de la méthode getItem de la classe Item
    public static function getItem($itemId) {
        if (!\Logics\Session::hasAccess()) {
            http_response_code(401);
            return;
        }
        
        $result = \Logics\Piece::getItem($itemId);

        if ($result->isValid()) {
            $data = new Wrapper('piece', $result->getData());
        } else {
            $data = $result->getErrors();
        }

        return \Utils::patchJson($data);
    }

    // Implémentation de la méthode getItems de la classe Item
    public static function getItems() {
        $args = \Utils::parseGetParam();
        $arrayData = array();

        if (!\Logics\Session::hasAccess()) {
            http_response_code(401);
            return;
        }

        if (array_key_exists('ids', $args) && count($args['ids']) != 0) {
            $result = \Logics\Piece::getItem($args['ids']);
        } else {
            $result = \Logics\Piece::getItem();
        }

        if ($result->isValid()) {
            $arrayData = $result->getData();
        }

        return \Utils::patchJson(new Wrapper('pieces', $arrayData));
    }

    // Implémentation de la méthode create de la classe ItemCreatable
    public static function create() {
        
    }

    // Implémentation de la méthode update de la classe ItemUpdatable
    public static function update($itemId) {
        
    }

}
