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
 * Contient les méthodes de gestion des pièces
 * @class Piece
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class Piece extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'Pieces';

    /**
     * ID de la pièce
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * ID du type de pièce
     * @property pieceType
     * @protected
     * @type integer
     * @default 0
     */
    protected $pieceType = 0;

    /**
     * Label de la pièce
     * @property label
     * @protected
     * @type string
     * @default 0
     */
    protected $label = "";

    /**
     * Référence pour l'ERP
     * @property erpRef
     * @protected
     * @type string
     * @default 
     */
    protected $erpRef = "";

    /**
     * Liste des climats pour lesquels la pièce est disponible
     * @property climats
     * @protected
     * @type integer[]
     * @default []
     */
    protected $climats = array();

    /**
     * Liste des options de la pièce
     * @property options
     * @protected
     * @type integer[]
     * @default []
     */
    protected $options = array();

    /**
     * Crée une nouvelle pièce (affecte la BDD)
     * @method create
     * @static
     * @param {Integer} pieceTypeId ID du type de pièce
     * @param {String} label Label de la pièce
     * @param {String} erpRef Référence pour l'ERP
     * @param {Integer[]} climats Liste des climats pour lesquels la pièce fonctionne
     * @param {Integer[]} conveyorTypes Liste des convoyeurs pour lesquels la pièce est disponible
     * @param {Integer[]} options Liste des options de la pièce
     * @return {Logics.Response}
     */
    public static function create($pieceTypeId, $label, $erpRef, $climats, $conveyorTypes, $options) {
        
    }

    /**
     * Met à jour une pièce (affecte la BDD)
     * @method update
     * @static
     * @param {Integer} pieceId ID de la pièce
     * @param {String} label Label de la pièce
     * @param {String} erpRef Référence pour l'ERP
     * @param {Integer[]} climats Liste des climats pour lesquels la pièce fonctionne
     * @param {Integer[]} options Liste des options de la pièce
     * @return {Logics.Response}
     */
    public static function update($pieceId, $label, $erpRef, $climats, $options) {
        
    }
    
    public function __construct() {
        if (!is_array($this->climats)) {
            $this->climats = is_null($this->climats) ? array() : explode(',', $this->climats);
        }
        if (!is_array($this->options)) {
            $this->options = is_null($this->options) ? array() : explode(',', $this->options);
        }
    }

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'pieceType' => $this->pieceType,
            'label' => $this->label,
            'erpRef' => $this->erpRef,
            'climats' => $this->climats,
            'options' => $this->options
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Piece/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID de la pièce 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Piece/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID de la pièce
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Piece/pieceType:property"}}{{/crossLink}}
     * @method getPieceType
     * @return {Integer} ID du type de la pièce
     */
    public function getPieceType() {
        return $this->pieceType;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Piece/pieceType:property"}}{{/crossLink}}
     * @method setPieceType
     * @param {Integer} newPieceType Nouvel ID du type de la pièce
     */
    public function setPieceType($newPieceType) {
        $this->pieceType = $newPieceType;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Piece/label:property"}}{{/crossLink}}
     * @method getLabel
     * @return {String} Label de la pièce
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Piece/label:property"}}{{/crossLink}}
     * @method setLabel
     * @param {String} newLabel Nouveau label de la pièce
     */
    public function setLabel($newLabel) {
        $this->label = $newLabel;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Piece/erpRef:property"}}{{/crossLink}}
     * @method getErpRef
     * @return {String} Référence pour l'ERP
     */
    public function getErpRef() {
        return $this->erpRef;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Piece/erpRef:property"}}{{/crossLink}}
     * @method setErpRef
     * @param {String} newErpRef Nouvelle référence pour l'ERP
     */
    public function setErpRef($newErpRef) {
        $this->erpRef = $newErpRef;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Piece/climats:property"}}{{/crossLink}}
     * @method getClimats
     * @return {Integer[]} Liste des climats pour lesquels la pièce fonctionne
     */
    public function getClimats() {
        return $this->climats;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Piece/climats:property"}}{{/crossLink}}
     * @method setClimats
     * @param {Integer[]} newClimats Nouvelle liste des climats pour lesquels la pièce fonctionne
     */
    public function setClimats($newClimats) {
        $this->climats = $newClimats;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Piece/options:property"}}{{/crossLink}}
     * @method getOptions
     * @return {Integer[]} Liste des options de la pièce
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Piece/options:property"}}{{/crossLink}}
     * @method setOptions
     * @param {Integer[]} newOptions Nouvelle liste des options de la pièce
     */
    public function setOptions($newOptions) {
        $this->options = $newOptions;
    }

}
