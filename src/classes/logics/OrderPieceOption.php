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
 * Contient les options d'une commande de pièce
 * @class OrderPieceOption
 * @constructor
 * @extends Logics.ItemOption
 * @namespace Logics
 */
class OrderPieceOption extends ItemOption {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'OrderPieceOptions';

    /**
     * ID de la commande de pièce concerné
     * @property orderPiece
     * @protected
     * @type integer
     * @default 0
     */
    protected $orderPiece = 0;
    protected $value = "";
    protected $optionType = 0;
    protected $option = 0;

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
        return array_merge(parent::jsonSerialize(), array('id' => $this->id,'orderPiece' => $this->orderPiece,'value' => $this->value,'optionType' => $this->optionType,'option' => $this->option);
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.PieceOrderOption/orderPiece:property"}}{{/crossLink}}
     * @method getOrderPiece
     * @return {Integer} ID de la commande de pièce concerné
     */
    public function getOrderPiece() {
        return $this->orderPiece;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.PieceOrderOption/orderPiece:property"}}{{/crossLink}}
     * @method setOrderPiece
     * @param {Integer} newOrderPiece Nouvel ID de la commande de pièce concerné
     */
    public function setOrderPiece($newOrderPiece) {
        $this->orderPiece = $newOrderPiece;
    }
        /**
     * Retourne la propriété {{#crossLink "Logics.PieceOrderOption/orderPiece:property"}}{{/crossLink}}
     * @method getOrderPiece
     * @return {Integer} ID de la commande de pièce concerné
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.PieceOrderOption/orderPiece:property"}}{{/crossLink}}
     * @method setOrderPiece
     * @param {Integer} newOrderPiece Nouvel ID de la commande de pièce concerné
     */
    public function setValue($newValue) {
        $this->value = $newValue;
    }
    public function getOption() {
        return $this->option;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.PieceOrderOption/orderPiece:property"}}{{/crossLink}}
     * @method setOrderPiece
     * @param {Integer} newOrderPiece Nouvel ID de la commande de pièce concerné
     */
    public function setOption($newValue) {
        $this->option = $newValue;
    }

public function getOptionType() {
        return $this->optionType;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.PieceOrderOption/orderPiece:property"}}{{/crossLink}}
     * @method setOrderPiece
     * @param {Integer} newOrderPiece Nouvel ID de la commande de pièce concerné
     */
    public function setOptionType($newValue) {
        $this->optionType = $newValue;
    }
}
