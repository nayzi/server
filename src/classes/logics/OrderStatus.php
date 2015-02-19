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
 * Contient la définition du status d'un bon de commande
 * @class OrderStatus
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class OrderStatus extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'OrderStatus';

    /**
     * ID du bon de commande
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * Nom et prénom de l'utilisateur ayant vérouillé le bon de commande
     * @property lockedBy
     * @protected
     * @type string
     * @default 
     */
    protected $lockedBy = "";

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'lockedBy' => $this->lockedBy
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.OrderStatus/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID du bon de commande
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.OrderStatus/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID du bon de commande
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.OrderStatus/lockedBy:property"}}{{/crossLink}}
     * @method getLockedBy
     * @return {String} Nom et prénom de l'utilisateur ayant vérouillé le bon de commande
     */
    public function getLockedBy() {
        return $this->lockedBy;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.OrderStatus/lockedBy:property"}}{{/crossLink}}
     * @method setLockedBy
     * @param {String} newLockedBy Nouveau nom et prénom de l'utilisateur ayant vérouillé le bon de commande
     */
    public function setLockedBy($newLockedBy) {
        $this->lockedBy = $newLockedBy;
    }

}
