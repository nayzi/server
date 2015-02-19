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
 * @class PieceType
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class PieceType extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'PieceTypes';

    /**
     * ID du type de pièce
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * ID du type de pièce parent
     * @property parentType
     * @protected
     * @type integer
     * @default null
     */
    protected $parentType = null;

    /**
     * Label du type de pièce
     * @property label
     * @protected
     * @type string
     * @default 
     */
    protected $label = "";

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'parentType' => $this->parentType,
            'label' => $this->label
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.PieceType/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID du type de pièce
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.PieceType/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID du type de pièce
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.PieceType/parentType:property"}}{{/crossLink}}
     * @method getParentType
     * @return {Integer|null} ID du type de pièce parent
     */
    public function getParentType() {
        return $this->parentType;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.PieceType/parentType:property"}}{{/crossLink}}
     * @method setParentType
     * @param {Integer} newParentType Nouvel ID du type de pièce parent
     */
    public function setParentType($newParentType) {
        $this->parentType = $newParentType;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.PieceType/label:property"}}{{/crossLink}}
     * @method getLabel
     * @return {String} Label du type de pièce
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.PieceType/label:property"}}{{/crossLink}}
     * @method setLabel
     * @param {String} newLabel Nouveau label du type de pièce
     */
    public function setLabel($newLabel) {
        $this->label = $newLabel;
    }

}
