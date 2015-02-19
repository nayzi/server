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
 * Contient les méthodes de gestion des climats
 * @class Climat
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class Climat extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'Climats';

    /**
     * ID du climat
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * Label du climat
     * @property label
     * @protected
     * @type string
     * @default
     */
    protected $label = "";

    /**
     * Abbréviation du climat (généralement une seule lettre).
     * Utile lors de l'export vers l'ERP
     * @property abbreviation
     * @protected
     * @type string
     * @default
     */
    protected $abbreviation = "";

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'label' => $this->label,
            'abbreviation' => $this->abbreviation
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Climat/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID du climat
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Climat/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID du climat
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Climat/label:property"}}{{/crossLink}}
     * @method getLabel
     * @return {String} Label du climat
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Climat/label:property"}}{{/crossLink}}
     * @method setLabel
     * @param {Integer} newLabel Nouveau label du climat
     */
    public function setLabel($newLabel) {
        $this->label = $newLabel;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Climat/abbreviation:property"}}{{/crossLink}}
     * @method getAbbreviation
     * @return {String} Abbréviation du climat
     */
    public function getAbbreviation() {
        return $this->abbreviation;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Climat/abbreviation:property"}}{{/crossLink}}
     * @method setAbbreviation
     * @param {String} newAbbreviation Nouvelle abbréviation du climat
     */
    public function setAbbreviation($newAbbreviation) {
        $this->abbreviation = $newAbbreviation;
    }

}
