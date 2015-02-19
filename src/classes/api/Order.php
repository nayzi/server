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
 * Regroupe les webservices relatifs aux bons de commande
 * @class Order
 * @static
 * @uses API.ItemUpdatable
 * @uses API.ItemCreatable
 * @uses API.ItemDeletable
 * @namespace API
 */
class Order implements ItemCreatable, ItemUpdatable, ItemDeletable {
    
    // Implémentation de la méthode getItem de la classe Item
    public static function getItem($itemId) {
        if (!\Logics\Session::hasAccess()) {
            http_response_code(401);
            return;
        }
        
        $result = \Logics\Order::getItem($itemId);

        if ($result->isValid()) {
            $data = new Wrapper('order', $result->getData());
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
            $result = \Logics\Order::getItem($args['ids']);
        } else {
            $result = \Logics\Order::getItem();
        }

        if ($result->isValid()) {
            $arrayData = $result->getData();
        }

        return \Utils::patchJson(new Wrapper('orders', $arrayData));
    }
    
    /**
     * Vérouille/Dévérouille un bon de commande
     * @method changeLockedStatus
     * @static
     * @param {Integer} oId ID du bon de commande
     * @return {JsonSerializable}
     */
    public static function changeLockedStatus($oId) {
        
    }

    /**
     * Indique si le bon de commande est vérouillé
     * @method isLocked
     * @static
     * @param {Integer} oId ID du bon de commande
     * @return {JsonSerializable}
     */
    public static function isLocked($oId) {
        
    }

    // Implémentation de la méthode create de la classe ItemCreatable
    public static function create() {
        $post = \Utils::getJsonInput();
        $order = $post['order'];
        
        if (!\Logics\Session::hasAccess(array(1, 2, 3, 4))) {
            http_response_code(403);
            return \Utils::patchJson(\Logics\ErrorMessage::get(0));
        }
        
        $result = \Logics\Order::create($order['deal'], $order['conveyorType'], $order['climat'], $order['bpe'], $order['drawerName'], $order['plan']);

        if ($result->isValid()) {
            $data = new Wrapper('order', $result->getData());
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
