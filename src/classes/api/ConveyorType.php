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
 * Regroupe les webservices relatifs aux types de convoyeur
 * @class ConveyorType
 * @static
 * @uses API.Item
 * @namespace API
 */
class ConveyorType implements Item {

    // Implémentation de la méthode getItem de la classe Item
    public static function getItem($itemId) {
        if (!\Logics\Session::hasAccess()) {
            http_response_code(401);
            return;
        }
        
        $result = \Logics\ConveyorType::getItem($itemId);

        if ($result->isValid()) {
            $data = new Wrapper('conveyorType', $result->getData());
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
            $result = \Logics\ConveyorType::getItem($args['ids']);
        } else {
            $result = \Logics\ConveyorType::getItem();
        }

        if ($result->isValid()) {
            $arrayData = $result->getData();
        }

        return \Utils::patchJson(new Wrapper('conveyorTypes', $arrayData));
    }

}
