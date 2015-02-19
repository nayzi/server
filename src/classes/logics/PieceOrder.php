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
 * Contient les méthodes de gestion des commandes de pièces
 * @class PieceOrder
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class PieceOrder extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'PieceOrders';

    /**
     * ID de la commande de pièce
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * ID du convoyeur associé à cette commande de pièce
     * @property conveyor
     * @protected
     * @type integer
     * @default 0
     */
    protected $conveyor = 0;

    /**
     * ID de la pièce commandé
     * @property orderPiece
     * @protected
     * @type integer
     * @default 0
     */
    protected $orderPiece = 0;

    /**
     * Nombre de pièces commandé
     * @property nbPieces
     * @protected
     * @type integer
     * @default 0
     */
    protected $nbPieces = 0;

    /**
     * Crée une commande de pièce (affecte la BDD)
     * @method create
     * @static
     * @param {Integer} conveyorId ID du convoyeur
     * @param {Integer} orderPieceId ID de la commande de pièce
     * @param {Integer} nbPieces Nombre de pièce
     * @return {Logics.Response}
     */
    public static function create($conveyorId, $orderPieceId, $nbPieces) {
        $result = new Response();

        $newId = \DB\DBInterface::get()->execute('call PieceOrders_create(:conveyor, :orderPiece, :nbPieces);', array(
            ':conveyor' => $conveyorId, ':orderPiece' => $orderPieceId, ':nbPieces' => $nbPieces
        ));

        if ($newId['id'] > 0) {
            $pieceOrder = \DB\DBInterface::get()->one('call PieceOrders_getItem(:id);', array(':id' => $newId['id']), '\Logics\PieceOrder');

            $result->setResult(TRUE);
            $result->setData($pieceOrder);
        } else {
            $result->addError(300);
        }

        return $result;
    }

    /**
     * Met à jour une commande de pièce (affecte la BDD)
     * @method update
     * @static
     * @param {Integer} pieceOrderId ID de la commande de pièce
     * @param {Integer} nbPieces Nombre de pièce
     * @return {Logics.Response}
     */
    public static function update($pieceOrderId, $nbPieces) {
        
    }

    /**
     * Supprime une commande de pièce
     * @method delete
     * @static
     * @param {Integer} pieceOrderId ID de la commande de pièce
     * @return {Logics.Response}
     */
    public static function delete($pieceOrderId) {
        
    }

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'conveyor' => $this->conveyor,
            'orderPiece' => $this->orderPiece,
            'nbPieces' => $this->nbPieces
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.PieceOrder/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID de la commande de pièce
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.PieceOrder/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID de la commande de pièce
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.PieceOrder/conveyor:property"}}{{/crossLink}}
     * @method getConveyor
     * @return {Integer} ID du convoyeur associé à cette commande de pièce
     */
    public function getConveyor() {
        return $this->conveyor;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.PieceOrder/conveyor:property"}}{{/crossLink}}
     * @method setConveyor
     * @param {Integer} newId Nouvel ID du convoyeur associé à cette commande de pièce
     */
    public function setConveyor($newConveyor) {
        $this->conveyor = $newConveyor;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.PieceOrder/orderPiece:property"}}{{/crossLink}}
     * @method getOrderPiece
     * @return {Integer} ID de la pièce commandé
     */
    public function getOrderPiece() {
        return $this->orderPiece;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.orderPiece/piece:property"}}{{/crossLink}}
     * @method setOrderPiece
     * @param {Integer} newPiece Nouvel ID de la pièce commandé
     */
    public function setOrderPiece($newOrderPiece) {
        $this->orderPiece = $newOrderPiece;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.PieceOrder/nbPieces:property"}}{{/crossLink}}
     * @method getNbPieces
     * @return {Integer} Nombre de pièces
     */
    public function getNbPieces() {
        return $this->nbPieces;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.PieceOrder/nbPieces:property"}}{{/crossLink}}
     * @method setNbPieces
     * @param {Integer} newNbPieces Nouveau nombre de pièces
     */
    public function setNbPieces($newNbPieces) {
        $this->nbPieces = $newNbPieces;
    }

}
