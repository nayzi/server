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
 * Contient les méthodes de gestion des types de convoyeur
 * @class ConveyorType
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class ConveyorType extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'ConveyorTypes';

    /**
     * ID du type de convoyeur
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * Label du type de convoyeur
     * @property label
     * @protected
     * @type string
     * @default
     */
    protected $label = "";

    /**
     * Abbréviation du type de convoyeur
     * @property abbreviation
     * @protected
     * @type string
     */
    protected $abbreviation = "";

    /**
     * Options disponible pour le type de convoyeur
     * @property conveyorTypeOptions
     * @protected
     * @type integer[]
     * @default []
     */
    protected $conveyorTypeOptions = array();

    /**
     * Pièces disponible pour le type de convoyeur
     * @property pieceAvailabilities
     * @protected
     * @type integer[]
     * @default []
     */
    protected $pieceAvailabilities = array();

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'label' => $this->label,
            'abbreviation' => $this->abbreviation,
            'conveyorTypeOptions' => $this->conveyorTypeOptions,
            'pieceAvailabilities' => $this->pieceAvailabilities
        );
    }
    
    /**
     * Répare le type des données lors d'une construction via PDO
     * @method __construct
     */
    public function __construct() {
        if (!is_array($this->conveyorTypeOptions)) {
            $this->conveyorTypeOptions = is_null($this->conveyorTypeOptions) ? array() : explode(',', $this->conveyorTypeOptions);
        }
        
        if (!is_array($this->pieceAvailabilities)) {
            $this->pieceAvailabilities = is_null($this->pieceAvailabilities) ? array() : explode(',', $this->pieceAvailabilities);
        }
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.ConveyorType/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID du type de convoyeur
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.ConveyorType/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID 
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.ConveyorType/label:property"}}{{/crossLink}}
     * @method getLabel
     * @return {String} Label du type de convoyeur 
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.ConveyorType/label:property"}}{{/crossLink}}
     * @method setLabel
     * @param {String} newLabel Nouveau label du type de convoyeur
     */
    public function setLabel($newLabel) {
        $this->label = $newLabel;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.ConveyorType/abbreviation:property"}}{{/crossLink}}
     * @method getAbbreviation
     * @return {String} Abbréviation du type de convoyeur
     */
    public function getAbbreviation() {
        return $this->abbreviation;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.ConveyorType/abbreviation:property"}}{{/crossLink}}
     * @method setAbbreviation
     * @param {String} newAbbreviation Nouvelle abbréviation du type de convoyeur
     */
    public function setAbbreviation($newAbbreviation) {
        $this->abbreviation = $newAbbreviation;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.ConveyorType/conveyorTypeOptions:property"}}{{/crossLink}}
     * @method getConveyorTypeOptions
     * @return {Integer[]} Liste des options disponibles pour le type de convoyeur
     */
    public function getConveyorTypeOptions() {
        return $this->conveyorTypeOptions;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.ConveyorType/conveyorTypeOptions:property"}}{{/crossLink}}
     * @method setConveyorTypeOptions
     * @param {Integer[]} newConveyorTypeOptions Nouvelle liste des options disponibles pour le type de convoyeur
     */
    public function setConveyorTypeOptions($newConveyorTypeOptions) {
        $this->conveyorTypeOptions = $newConveyorTypeOptions;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.ConveyorType/pieces:property"}}{{/crossLink}}
     * @method getPieceAvailabilities
     * @return {Integer[]} Liste des pieces disponibles pour le type de convoyeur
     */
    public function getPieceAvailabilities() {
        return $this->pieceAvailabilities;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.ConveyorType/pieces:property"}}{{/crossLink}}
     * @method setPieceAvailabilities
     * @param {Integer[]} newPieces Nouvelle liste des pieces disponibles pour le type de convoyeur
     */
    public function setPieceAvailabilities($newPieceAvailabilities) {
        $this->pieceAvailabilities = $newPieceAvailabilities;
    }

}
