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
 * Contient les méthodes de gestion de la liste des pièces disponibles pour un bon de commande
 * @class OrderPiece
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class OrderPiece extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'OrderPieces';

    /**
     * ID de la commande de pièce
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * ID du bon de commande lié
     * @property order
     * @protected
     * @type integer
     * @default 0
     */
    protected $order = 0;

    /**
     * ID de la pièce commandé
     * @property piece
     * @protected
     * @type integer
     * @default 0
     */
    protected $piece = 0;

    /**
     * Indique si c'est une commande automatique
     * @property isComputed
     * @protected
     * @type boolean
     * @default 0
     */
    protected $isComputed = 0;

    /**
     * Liste des options
     * @property options
     * @protected
     * @type integer[]
     * @default []
     */
    protected $orderPieceOptions = array();

    /**
     * Crée une commande de pièce (affecte la BDD)
     * @method create
     * @static
     * @param {Integer} orderId ID du bon de commande
     * @param {Integer} pieceId ID de la pièce
     * @param {Integer} isComputed Commande automatique
     * @return {Logics.Response}
     */
    public static function create($orderId, $pieceId, $isComputed) {
        $result = new Response();

        $newId = \DB\DBInterface::get()->execute('call OrderPieces_create(:order, :piece, :isComputed);', array(
            ':order' => $orderId, ':piece' => $pieceId, ':isComputed' => $isComputed
        ));

        if ($newId['id'] > 0) {
            $orderPiece = \DB\DBInterface::get()->one('call OrderPieces_getItem(:id);', array(':id' => $newId['id']), '\Logics\OrderPiece');

            $result->setResult(TRUE);
            $result->setData($orderPiece);
        } else {
            $result->addError(300);
        }

        return $result;
    }

    /**
     * Met à jour une commande de pièce (affecte la BDD)
     * @method update
     * @static
     * @param {Integer} orderPieceId ID de la commande de pièce
     * @param {Integer} pieceId ID de la pièce
     * @return {Logics.Response}
     */
    public static function update($orderPieceId, $pieceId) {
        
    }

    /**
     * Supprime une commande de pièce
     * @method delete
     * @static
     * @param {Integer} orderPieceId ID de la commande de pièce
     * @return {Logics.Response}
     */
    public static function delete($orderPieceId) {
        
    }
    
    public function __construct() {
        if (!is_array($this->orderPieceOptions)) {
            $this->orderPieceOptions = is_null($this->orderPieceOptions) ? array() : explode(',', $this->orderPieceOptions);
        }
    }

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'order' => $this->order,
            'piece' => $this->piece,
            'isComputed' => $this->isComputed,
            'orderPieceOptions' => $this->orderPieceOptions
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.OrderPiece/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID de la commande de pièce
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.OrderPiece/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID de la commande de pièce
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.OrderPiece/order:property"}}{{/crossLink}}
     * @method getOrder
     * @return {Integer} ID du bon de commande lié
     */
    public function getOrder() {
        return $this->order;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.OrderPiece/order:property"}}{{/crossLink}}
     * @method setOrder
     * @param {Integer} newOrder Nouvel ID du bon de commande lié
     */
    public function setOrder($newOrder) {
        $this->order = $newOrder;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.OrderPiece/piece:property"}}{{/crossLink}}
     * @method getPiece
     * @return {Integer} ID de la pièce commandé
     */
    public function getPiece() {
        return $this->piece;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.OrderPiece/piece:property"}}{{/crossLink}}
     * @method setPiece
     * @param {Integer} newPiece Nouvel ID de la pièce commandé
     */
    public function setPiece($newPiece) {
        $this->piece = $newPiece;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.OrderPiece/isComputed:property"}}{{/crossLink}}
     * @method getIsComputed
     * @return {Integer} Indique si c'est une commande automatique
     */
    public function getIsComputed() {
        return $this->isComputed;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.OrderPiece/isComputed:property"}}{{/crossLink}}
     * @method setIsComputed
     * @param {Integer} newIsComputed Nouvelle indication de commande automatique
     */
    public function setIsComputed($newIsComputed) {
        $this->isComputed = $newIsComputed;
    }
    /**
     * Retourne la propriété {{#crossLink "Logics.OrderPiece/isComputed:property"}}{{/crossLink}}
     * @method getIsComputed
     * @return {Integer} Indique si c'est une commande automatique
     */
    public function getOrderPieceOptions() {
        
        return $this->orderPieceOptions;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.OrderPiece/isComputed:property"}}{{/crossLink}}
     * @method setIsComputed
     * @param {Integer} newIsComputed Nouvelle indication de commande automatique
     */
    public function setOrderPieceOptions($newOptions) {
        $this->orderPieceOptions = $newOptions;
    }

}
