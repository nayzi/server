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
 * Regroupe les webservices relatifs aux options de convoyeur
 * @class ConveyorOption
 * @static
 * @uses API.ItemUpdatable
 * @uses API.ItemCreatable
 * @uses API.ItemDeletable
 * @namespace API
 */
class ConveyorOption implements ItemCreatable, ItemDeletable, ItemUpdatable {
    
    // Implémentation de la méthode getItem de la classe Item
    public static function getItem($itemId) {
        if (!\Logics\Session::hasAccess()) {
            http_response_code(401);
            return;
        }
        
        $result = \Logics\ConveyorOption::getItem($itemId);

        if ($result->isValid()) {
            $data = new Wrapper('conveyorOption', $result->getData());
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
            $result = \Logics\ConveyorOption::getItem($args['ids']);
        } else {
            $result = \Logics\ConveyorOption::getItem();
        }

        if ($result->isValid()) {
            $arrayData = $result->getData();
        }

        return \Utils::patchJson(new Wrapper('conveyorOptions', $arrayData));
    }
    
    // Implémentation de la méthode create de la classe ItemCreatable
    public static function create() {
        $post = \Utils::getJsonInput();
        $conveyorOption = $post['conveyorOption'];
        
        if (!\Logics\Session::hasAccess(array(1, 2, 3, 4))) {
            http_response_code(403);
            return \Utils::patchJson(\Logics\ErrorMessage::get(0));
        }
        
        $result = \Logics\ConveyorOption::create($conveyorOption['conveyor'], $conveyorOption['optionType'], $conveyorOption['option'], $conveyorOption['optionValue']);

        if ($result->isValid()) {
            $data = new Wrapper('conveyorOption', $result->getData());
            http_response_code(201);
        } else {
            $data = $result->getErrors();
        }

        return \Utils::patchJson($data);
    }

    // Implémentation de la méthode update de la classe ItemUpdatable
    public static function update($itemId) {
        
    }

    // Implémentation de la méthode delete de la classe ItemDeletable
    public static function delete($itemId) {
        
    }

}
