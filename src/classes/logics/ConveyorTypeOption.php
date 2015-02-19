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
 * Contient les méthodes de gestion des disponibilités d'option pour type de convoyeur
 * @class ConveyorTypeOption
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class ConveyorTypeOption extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'ConveyorTypeOptions';

    /**
     * ID de la disponibilité d'option du type de convoyeur
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * ID du type de convoyeur lié
     * @property conveyorType
     * @protected
     * @type integer
     * @default 0
     */
    protected $conveyorType = 0;

    /**
     * ID de l'option associé
     * @property option
     * @protected
     * @type integer
     * @default 0
     */
    protected $option = 0;

    /**
     * Défini si c'est une option personnalisable au niveau du convoyeur
     * @property isConveyorOption
     * @protected
     * @type boolean
     * @default false
     */
    protected $isConveyorOption = FALSE;

    /**
     * Défini si c'est une option personnalisable au niveau du bon de commande
     * @property isOrderOption
     * @protected
     * @type boolean
     * @default false
     */
    protected $isOrderOption = FALSE;

    /**
     * Ajoute une disponibilité d'option pour un type de convoyeur
     * @method create
     * @static
     * @param {Integer} conveyorTypeId ID du type de convoyeur
     * @param {Integer} optionId ID de l'option à rendre disponible
     * @param {Boolean} isConveyorOption Autorise la personnalisation au niveau du convoyeur
     * @param {Boolean} isOrderOption Autorise la personnalisation au niveau du bon de commande
     * @return {Logics.Response}
     */
    public static function create($conveyorTypeId, $optionId, $isConveyorOption, $isOrderOption) {
        
    }

    /**
     * Met à jour une disponibilité d'option pour un type de convoyeur
     * @method update
     * @static
     * @param {Integer} conveyorTypeOptionId ID de la disponibilité
     * @param {Boolean} isConveyorOption Autorise la personnalisation au niveau du convoyeur
     * @param {Boolean} isOrderOption Autorise la personnalisation au niveau du bon de commande
     * @return {Logics.Response}
     */
    public static function update($conveyorTypeOptionId, $isConveyorOption, $isOrderOption) {
        
    }

    /**
     * Supprime une disponibilité d'option
     * @method delete
     * @static
     * @param {Integer} conveyorTypeOptionId ID de la disponibilité
     * @return 
     */
    public function delete($conveyorTypeOptionId) {
        
    }

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'conveyorType' => $this->conveyorType,
            'option' => $this->option,
            'isConveyorOption' => $this->isConveyorOption,
            'isOrderOption' => $this->isOrderOption
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.ConveyorTypeOption/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID de la disponibilité d'option
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.ConveyorTypeOption/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID de la disponibilité d'option
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.ConveyorTypeOption/conveyorType:property"}}{{/crossLink}}
     * @method getConveyorType
     * @return {Integer} ID de la disponibilité d'option
     */
    public function getConveyorType() {
        return $this->conveyorType;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.ConveyorTypeOption/conveyorType:property"}}{{/crossLink}}
     * @method setConveyorType
     * @param {Integer} newId Nouvel ID du type de convoyeur lié
     */
    public function setConveyorType($newConveyorType) {
        $this->conveyorType = $newConveyorType;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.ConveyorTypeOption/option:property"}}{{/crossLink}}
     * @method getOption
     * @return {Integer} ID de l'option associé
     */
    public function getOption() {
        return $this->option;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.ConveyorTypeOption/option:property"}}{{/crossLink}}
     * @method setOption
     * @param {Integer} newOption Nouvel ID de l'option associé
     */
    public function setOption($newOption) {
        $this->option = $newOption;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.ConveyorTypeOption/isConveyorOption:property"}}{{/crossLink}}
     * @method isConveyorOption
     * @return {Boolean} Indique si c'est une option disponible au niveau du convoyeur
     */
    public function isConveyorOption() {
        return $this->isConveyorOption;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.ConveyorTypeOption/isConveyorOption:property"}}{{/crossLink}}
     * @method setIsConveyorOption
     * @param {Boolean} newIsConveyorOption 
     */
    public function setIsConveyorOption($newIsConveyorOption) {
        $this->isConveyorOption = $newIsConveyorOption;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.ConveyorTypeOption/isOrderOption:property"}}{{/crossLink}}
     * @method isOrderOption
     * @return {Boolean} Indique si c'est une option disponible au niveau du bon de commande
     */
    public function isOrderOption() {
        return $this->isOrderOption;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.ConveyorTypeOption/isOrderOption:property"}}{{/crossLink}}
     * @method setIsOrderOption
     * @param {Boolean} newIsOrderOption
     */
    public function setIsOrderOption($newIsOrderOption) {
        $this->isOrderOption = $newIsOrderOption;
    }

}
