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
 * Contient les méthodes de gestion des options
 * @class Option
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class Option extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'Options';

    /**
     * ID de l'option
     * @property id
     * @protected
     * @type integer
     */
    protected $id = 0;

    /**
     * ID du type de l'option
     * @property optionType
     * @protected
     * @type integer
     */
    protected $optionType = 0;

    /**
     * Label de l'option
     * @property label
     * @protected
     * @type string
     */
    protected $label = "";

    /**
     * Valeur de l'option
     * @property value
     * @protected
     * @type string
     */
    protected $value = "";

    /**
     * Défini si la valeur de l'option est personnalisable
     * @property isCustomizable
     * @protected
     * @type boolean
     */
    protected $isCustomizable = FALSE;

    /**
     * Défini si l'option est active
     * @property isActive
     * @protected
     * @type boolean
     */
    protected $isActive = FALSE;

    /**
     * Défini si c'est l'option par défaut
     * @property isDefault
     * @protected
     * @type boolean
     */
    protected $isDefault = FALSE;

    /**
     * Crée une nouvelle option (affecte la BDD)
     * @method create
     * @param {Integer} optionTypeId ID du type d'option
     * @param {String} label Label de l'option
     * @param {String} value Valeur de l'option
     * @param {Boolean} isCustomizable Indique s'il est possible de personnaliser l'option
     * @param {Boolean} isDefault Indique si c'est l'option par défaut
     * @return {Logics.Response}
     */
    public static function create($optionTypeId, $label, $value, $isCustomizable, $isDefault) {
        
    }

    /**
     * Met à jour une option (affecte la BDD)
     * @method update
     * @param {optionId} ID de l'option
     * @param {String} label Label de l'option
     * @param {Boolean} isDefault Indique si c'est l'option par défaut
     * @param {Boolean} isActive Indique si l'option est active
     * @return 
     */
    public static function update($optionId, $label, $isDefault, $isActive) {
        
    }

    /**
     * Désactive une option (affecte la BDD)
     * @method deactivate
     * @param {Integer} optionId ID de l'option
     * @return {Logics.Response}
     */
    public static function deactivate($optionId) {
        
    }

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'optionType' => $this->optionType,
            'isActive' => $this->isActive,
            'isCustomizable' => $this->isCustomizable,
            'isDefault' => $this->isDefault,
            'label' => $this->label,
            'value' => $this->value
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Option/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID de l'option 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Option/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID de l'option
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Option/optionType:property"}}{{/crossLink}}
     * @method getOptionType
     * @return {Integer} ID du type d'option
     */
    public function getOptionType() {
        return $this->optionType;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Option/optionType:property"}}{{/crossLink}}
     * @method setOptionType
     * @param {Integer} newOptionType Nouvel ID de type d'option
     */
    public function setOptionType($newOptionType) {
        $this->optionType = $newOptionType;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Option/label:property"}}{{/crossLink}}
     * @method getLabel
     * @return {String} Label de l'option
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Option/label:property"}}{{/crossLink}}
     * @method setLabel
     * @param {String} newLabel Nouveau label de l'option
     */
    public function setLabel($newLabel) {
        $this->label = $newLabel;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Option/value:property"}}{{/crossLink}}
     * @method getValue
     * @return {String} Valeur de l'option
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Option/value:property"}}{{/crossLink}}
     * @method setValue
     * @param {String} newValue Nouvelle valeur de l'option
     */
    public function setValue($newValue) {
        $this->value = $newValue;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Option/isCustomizable:property"}}{{/crossLink}}
     * @method isCustomizable
     * @return {Boolean} Indique si l'option est personnalisable 
     */
    public function isCustomizable() {
        return $this->isCustomizable;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Option/isCustomizable:property"}}{{/crossLink}}
     * @method setIsCustomizable
     * @param {Boolean} newIsCustomizable Nouvel état de personnalisation
     */
    public function setIsCustomizable($newIsCustomizable) {
        $this->isCustomizable = $newIsCustomizable;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Option/idActive:property"}}{{/crossLink}}
     * @method isActive
     * @return {IsActive} 
     */
    public function isActive() {
        return $this->isActive;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Option/isActive:property"}}{{/crossLink}}
     * @method setIsActive
     * @param {Boolean} newIsActive Nouvel état d'activation
     */
    public function setIsActive($newIsActive) {
        $this->isActive = $newIsActive;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Option/isDefault:property"}}{{/crossLink}}
     * @method isDefault
     * @return {Boolean} Indique si c'est l'option par défaut 
     */
    public function isDefault() {
        return $this->isDefault;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Option/isDefault:property"}}{{/crossLink}}
     * @method setIsDefault
     * @param {Boolean} newIsDefault Nouvel indication de d'option par défaut
     */
    public function setIsDefault($newIsDefault) {
        $this->isDefault = $newIsDefault;
    }

}
