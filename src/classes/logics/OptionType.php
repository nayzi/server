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
 * Contient les méthodes de gestion des types d'options
 * @class OptionType
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class OptionType extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'OptionTypes';

    /**
     * ID du type d'option
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * Label du type d'option
     * @property label
     * @protected
     * @type string
     */
    protected $label = "";
    protected $replace = "";

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'label' => $this->label,
            'replace' => $this->replace
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.OptionType/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID du type d'option
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.OptionType/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID du type d'option
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.OptionType/label:property"}}{{/crossLink}}
     * @method getLabel
     * @return {String} Label du type d'option
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.OptionType/label:property"}}{{/crossLink}}
     * @method setLabel
     * @param {String} newLabel Nouveau label du type d'option
     */
    public function setLabel($newLabel) {
        $this->label = $newLabel;
    }
        /**
     * Retourne la propriété {{#crossLink "Logics.OptionType/label:property"}}{{/crossLink}}
     * @method getLabel
     * @return {String} Label du type d'option
     */
    public function getReplace() {
        return $this->label;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.OptionType/label:property"}}{{/crossLink}}
     * @method setLabel
     * @param {String} newLabel Nouveau label du type d'option
     */
    public function setReplace($newReplace) {
        $this->label = $newReplace;
    }

}
