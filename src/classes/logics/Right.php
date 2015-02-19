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
 * Contient les méthodes de gestion des droits d'accès
 * @class Right
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class Right extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'Rights';

    /**
     * ID du droit d'accès
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * Label du droit d'accès
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
            'label' => $this->label
        );
    }

    /**
     * Retourne l'ID du droit d'accès
     * @method getId
     * @return {Integer} id ID du droit d'accès
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour l'ID du droit d'accès
     * @method setId
     * @param {Integer} newId Nouvel ID
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne le label du droit d'acccès
     * @method getLabel
     * @return {String} label 
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Met à jour le label du droit d'accès
     * @method setLabe
     * @param {String} newLabel Nouveau label
     */
    public function setLabel($newLabel) {
        $this->label = $newLabel;
    }

}
