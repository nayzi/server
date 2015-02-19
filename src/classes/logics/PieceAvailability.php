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
 * Contient les méthodes de gestion des disponibilités de pièce pour les types de convoyeur
 * @class PieceAvailability
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class PieceAvailability extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'PieceAvailabilities';

    /**
     * ID de la disponibilité de pièce
     * @property id
     * @protected
     * @type {Integer}
     * @default 0
     */
    protected $id = 0;

    /**
     * ID de la pièce concerné
     * @property piece
     * @protected
     * @type {Integer}
     * @default 0
     */
    protected $piece = 0;

    /**
     * ID du type de convoyeur concerné
     * @property conveyorType
     * @protected
     * @type {Integer}
     * @default 0
     */
    protected $conveyorType = 0;

    /**
     * Défini si la puèce est effectivement disponible
     * @property isActive
     * @protected
     * @type {Boolean}
     * @default false
     */
    protected $isActive = false;

    /**
     * Crée une nouvelle disponibilité (affecte la BDD)
     * @method create
     * @static
     * @param {Integer} pieceId ID de la pièce
     * @param {Integer} conveyorTypeId ID du type de convoyeur
     * @return {Logics.Response}
     */
    public static function create($pieceId, $conveyorTypeId) {
        
    }

    /**
     * Met à jour une disponibilité (affecte la BDD)
     * @method update
     * @static
     * @param {Integer} pieceAvailabilityId ID de la disponibilité
     * @param {Boolean} isActive Nouvel état de la disponibilité
     * @return {Logics.Response}
     */
    public static function update($pieceAvailabilityId, $isActive) {
        
    }

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'piece' => $this->piece,
            'conveyorType' => $this->conveyorType,
            'isActive' => $this->isActive
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.PieceAvailability/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID de la pièce 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.PieceAvailability/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID de la pièce
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.PieceAvailability/piece:property"}}{{/crossLink}}
     * @method getPiece
     * @return {Integer} ID de la pièce
     */
    public function getPiece() {
        return $this->piece;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.PieceAvailability/piece:property"}}{{/crossLink}}
     * @method setPiece
     * @param {Integer} newPiece Nouvel ID de la pièce
     */
    public function setPiece($newPiece) {
        $this->piece = $newPiece;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.PieceAvailability/conveyorType:property"}}{{/crossLink}}
     * @method getConveyorType
     * @return {Integer} ID du type de convoyeur
     */
    public function getConveyorType() {
        return $this->conveyorType;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.PieceAvailability/conveyorType:property"}}{{/crossLink}}
     * @method setConveyorType
     * @param {Integer} newConveyorType Nouvel ID du type de convoyeur
     */
    public function setConveyorType($newConveyorType) {
        $this->conveyorType = $newConveyorType;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.PieceAvailability/isActive:property"}}{{/crossLink}}
     * @method isActive
     * @return {Boolean} Indique si la disponibilité est active 
     */
    public function isActive() {
        return $this->isActive;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.PieceAvailability/isActive:property"}}{{/crossLink}}
     * @method setIsActive
     * @param {Boolean} newIsActive Nouvel état d'activation de la disponibilité
     */
    public function setIsActive($newIsActive) {
        $this->isActive = $newIsActive;
    }

}
