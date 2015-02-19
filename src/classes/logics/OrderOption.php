<?php

namespace Logics;

// Make sure we don't directly access the file
if (!defined("IS_SECURE") || !IS_SECURE)
    die('I don\'t like you');

/*
 * @license PASC Client - Fives
 * Available via the MIT or new BSD license.
 */

/**
 * @module Logics
 */

/**
 * Contient les options d'un bon de commande
 * @class OrderOption
 * @constructor
 * @extends Logics.ItemOption
 * @namespace Logics
 */
class OrderOption extends ItemOption {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'OrderOptions';

    /**
     * ID du bon de commande concerné
     * @property order
     * @protected
     * @type integer
     * @default 0
     */
    protected $order = 0;

    // Implémentation de la méthode update de la classe ItemOption
    public static function update($itemOptionId, $optionId, $optionValue) {
        $result = new Response();

        return $result;
    }

    // Implémentation de la méthode delete de la classe ItemOption
    public static function delete($itemOptionId) {
        $result = new Response();

        return $result;
    }
    
    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), array('order' => $this->order));
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.OrderOption/order:property"}}{{/crossLink}}
     * @method getOrder
     * @return {Integer} ID du bon de commande concerné
     */
    public function getOrder() {
        return $this->order;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.OrderOption/order:property"}}{{/crossLink}}
     * @method setOrder
     * @param {Integer} newOrder Nouvel ID du bon de commande concerné
     */
    public function setOrder($newOrder) {
        $this->order = $newOrder;
    }

}
