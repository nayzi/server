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
 * Contient les méthodes de gestion des définitions d'options
 * @class ItemOption
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
abstract class ItemOption extends Item implements \JsonSerializable {

    /**
     * ID de l'enregistrement
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * ID du type d'option concerné
     * @property optionType
     * @protected
     * @type integer
     * @default 0
     */
    protected $optionType = 0;

    /**
     * ID de l'option concerné
     * @property option
     * @protected
     * @type integer
     * @default 0
     */
    protected $option = 0;

    /**
     * Valeur personnalisé de l'option
     * @property optionValue
     * @protected
     * @type string
     */
    protected $optionValue = "";

    /**
     * Crée une nouvelle définition d'option (affecte la BDD)
     * @method create
     * @static
     * @param {Integer} itemId ID de l'item concerné
     * @param {Integer} optionTypeId ID du type d'option concerné
     * @param {Integer} optionId ID de l'option concerné
     * @param {String} optionValue Valeur personnalisé de l'option
     * @return {Logics.Response}
     */
    public static function create($itemId, $optionTypeId, $optionId, $optionValue) {
        $result = new Response();

        $newId = \DB\DBInterface::get()->execute('call ' . static::$itemTable . '_create(:item, :optionType, :option, :optionValue);', array(
            ':item' => $itemId, ':optionType' => $optionTypeId, ':option' => $optionId,
            ':optionValue' => $optionValue
        ));

        if ($newId['id'] > 0) {
            $itemOption = \DB\DBInterface::get()->one('call ' . static::$itemTable . '_getItem(:id);', array(':id' => $newId['id']), get_called_class());

            $result->setResult(TRUE);
            $result->setData($itemOption);
        } else {
            $result->addError(300);
        }

        return $result;
    }

    /**
     * Met à jour un enregistrement (affecte la BDD)
     * @method update
     * @static
     * @param {ItemOptionId} ID de l'enregistrement
     * @param {Integer} optionId ID de l'option concerné
     * @param {String} optionValue Valeur personnalisé de l'option
     * @return {Logics.Response}
     */
    public abstract static function update($itemOptionId, $optionId, $optionValue);

    /**
     * Supprime un enregistrement (affecte la BDD)
     * @method delete
     * @static
     * @param {Integer} itemOptionId ID de l'enregistrement
     * @return {Logics.Response}
     */
    public abstract static function delete($itemOptionId);

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'optionType' => $this->optionType,
            'option' => $this->option,
            'optionValue' => $this->optionValue
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.ItemOption/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID de l'enregistrement
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.ItemOption/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID de l'enregistrement
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.ItemOption/optionType:property"}}{{/crossLink}}
     * @method getOptionType
     * @return {Integer} ID du type d'option concerné
     */
    public function getOptionType() {
        return $this->optionType;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.ItemOption/optionType:property"}}{{/crossLink}}
     * @method setOptionType
     * @param {Integer} newOptionType Nouvel ID du type d'option concerné
     */
    public function setOptionType($newOptionType) {
        $this->optionType = $newOptionType;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.ItemOption/option:property"}}{{/crossLink}}
     * @method getOption
     * @return {Integer} ID de l'option concerné
     */
    public function getOption() {
        return $this->option;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.ItemOption/option:property"}}{{/crossLink}}
     * @method setOption
     * @param {Integer} newOption Nouvel ID de l'option concerné
     */
    public function setOption($newOption) {
        $this->option = $newOption;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.ItemOption/optionValue:property"}}{{/crossLink}}
     * @method getOptionValue
     * @return {String} Valeur personnalisé de l'option
     */
    public function getOptionValue() {
        return $this->optionValue;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.ItemOption/optionValue:property"}}{{/crossLink}}
     * @method setOptionValue
     * @param {String} newOptionValue Nouvelle valeur personnalisé de l'option
     */
    public function setOptionValue($newOptionValue) {
        $this->optionValue = $newOptionValue;
    }

}
