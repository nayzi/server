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
 * Contient les options d'un convoyeur
 * @class ConveyorOption
 * @constructor
 * @extends Logics.ItemOption
 * @namespace Logics
 */
class ConveyorOption extends ItemOption {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'ConveyorOptions';

    /**
     * ID du convoyeur concerné
     * @property conveyor
     * @protected
     * @type integer
     * @default 0
     */
    protected $conveyor = 0;

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
        return array_merge(parent::jsonSerialize(), array('conveyor' => $this->conveyor));
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.ConveyorOption/conveyor:property"}}{{/crossLink}}
     * @method getConveyor
     * @return {Integer} ID du convoyeur concerné
     */
    public function getConveyor() {
        return $this->conveyor;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.ConveyorOption/conveyor:property"}}{{/crossLink}}
     * @method setConveyor
     * @param {Integer} newConveyor Nouvel ID du convoyeur concerné
     */
    public function setConveyor($newConveyor) {
        $this->conveyor = $newConveyor;
    }

}
