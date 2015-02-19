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
 * Contient les méthodes de gestion des climats
 * @class Conveyor
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class Conveyor extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'Conveyors';

    /**
     * ID du convoyeur
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * Repère du convoyeur
     * @property ref
     * @protected
     * @type string
     * @default
     */
    protected $ref = "";

    /**
     * Entre-guide du convoyeur (si redéfinition par rapport à l'affaire)
     * @property eg
     * @protected
     * @type integer
     * @default 0
     */
    protected $eg = 0;

    /**
     * Zone du convoyeur
     * @property zone
     * @protected
     * @type string
     * @default
     */
    protected $zone = "";

    /**
     * Code RAL utilisé pour le convoyeur (si différent du RAL affaire)
     * @property ral
     * @protected
     * @type string
     * @default null
     */
    protected $ral = NULL;

    /**
     * Code RAL utilisé pour les éléments sous le convoyeur (si différent du RAL affaire)
     * @property ralUnderConveyor
     * @protected
     * @type string
     * @default null
     */
    protected $ralUnderConveyor = NULL;

    /**
     * Position du convoyeur dans la liste
     * @property position
     * @protected
     * @type integer
     * @default 0
     */
    protected $position = 0;

    /**
     * Liste des pièces à commander pour ce convoyeur
     * @property pieceOrders
     * @protected
     * @type {Integer[]}
     * @default 0
     */
    protected $pieceOrders = array();

    /**
     * Liste des options pour ce convoyeur
     * @property options
     * @protected
     * @type {Integer[]}
     * @default 0
     */
    protected $options = 0;

    /**
     * Met à jour un convoyeur (affecte la BDD)
     * @method update
     * @static
     * @param {Integer} conveyorId ID du convoyeur à mettre à jour
     * @param {Integer} position Position du convoyeur
     * @param {String} ref Repère du convoyeur
     * @param {Integer} EG Entre-guide du convoyeur
     * @param {String} zone Zone du convoyeur
     * @param {String} ral Code couleur RAL du convoyeur (si différent du RAL affaire)
     * @param {String} ralUnderConveyor Code couleur RAL des éléments sous le convoyeur (si différent du RAL affaire)
     * @return {Logics.Response}
     */
    public static function update($conveyorId, $position, $ref, $EG, $zone, $ral, $ralUnderConveyor) {
        $result = new Response();

        return $result;
    }

    /**
     * Crée un nouveau convoyeur pour un bon de commande
     * @method create
     * @static
     * @param {Integer} orderId ID du bon de commande
     * @param {Integer} position Position du convoyeur
     * @param {String} ref Repère du convoyeur
     * @param {Integer} EG Entre-guide du convoyeur
     * @param {String} zone Zone du convoyeur
     * @param {String} ral Code couleur RAL du convoyeur (si différent du RAL affaire)
     * @param {String} ralUnderConveyor Code couleur RAL des éléments sous le convoyeur (si différent du RAL affaire)
     * @return {Logics.Response}
     */
    public static function create($orderId, $position, $ref, $EG, $zone, $ral, $ralUnderConveyor) {
        $result = new Response();
        
        $newId = \DB\DBInterface::get()->execute('call Conveyors_create(:orderId, :position, :ref, :zone, :eg, :ral, :ralU);', array(
            ':orderId' => $orderId, ':position' => $position, ':ref' => $ref,
            'zone' => $zone, ':eg' => $EG, ':ral' => $ral, ':ralU' => $ralUnderConveyor
        ));

        if ($newId['id'] > 0) {
            $conveyor = \DB\DBInterface::get()->one('call Conveyors_getItem(:id);', array(':id' => $newId['id']), '\Logics\Conveyor');
            
            $result->setResult(TRUE);
            $result->setData($conveyor);
        } else {
            $result->addError(300);
        }

        return $result;
    }

    /**
     * Supprime un convoyeur et les pièces associées
     * @method delete
     * @static
     * @param {conveyorId} ID du convoyeur à supprimer
     * @return {Logics.Response}
     */
    public static function delete($conveyorId) {
        $result = new Response();

        return $result;
    }

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'ref' => $this->ref,
            'eg' => $this->eg,
            'zone' => $this->zone,
            'ral' => $this->ral,
            'ralUnderConveyor' => $this->ralUnderConveyor,
            'position' => $this->position,
            'pieceOrders' => $this->pieceOrders,
            'options' => $this->options
        );
    }
    
    /**
     * Répare le type des données lors d'une construction via PDO
     * @method __construct
     */
    public function __construct() {
        if (!is_array($this->pieceOrders)) {
            $this->pieceOrders = is_null($this->pieceOrders) ? array() : explode(',', $this->pieceOrders);
        }
        
        if (!is_array($this->options)) {
            $this->options = is_null($this->options) ? array() : explode(',', $this->options);
        }
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Conveyor/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID du convoyeur
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Conveyor/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID du convoyeur
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Conveyor/ref:property"}}{{/crossLink}}
     * @method getRef
     * @return {String} Repère du convoyeur
     */
    public function getRef() {
        return $this->ref;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Conveyor/ref:property"}}{{/crossLink}}
     * @method setRef 
     * @param {String} newRef Nouveau repère du convoyeur
     */
    public function setRef($newRef) {
        $this->ref = $newRef;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Conveyor/eg:property"}}{{/crossLink}}
     * @method getEg
     * @return {Integer} Entre-guide du convoyeur
     */
    public function getEg() {
        return $this->eg;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Conveyor/eg:property"}}{{/crossLink}}
     * @method setEg
     * @param {Integer} newEg Nouvel entre-guide du convoyeur
     */
    public function setEg($newEg) {
        $this->eg = $newEg;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Conveyor/zone:property"}}{{/crossLink}}
     * @method getZone
     * @return {String} Zone du convoyeur
     */
    public function getZone() {
        return $this->zone;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Conveyor/zone:property"}}{{/crossLink}}
     * @method setZone
     * @param {String} newZone Nouvelle zone du convoyeur
     */
    public function setZone($newZone) {
        $this->zone = $newZone;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Conveyor/ral:property"}}{{/crossLink}}
     * @method getRal
     * @return {String} Code couleur RAL du convoyeur (si différent du RAL affaire)
     */
    public function getRal() {
        return $this->ral;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Conveyor/ral:property"}}{{/crossLink}}
     * @method setRal
     * @param {String} newRal Nouveau code couleur RAL
     */
    public function setRal($newRal) {
        $this->ral = $newRal;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Conveyor/ralUnderConveyor:property"}}{{/crossLink}}
     * @method getRalUnderConveyor
     * @return {String} Code couleur RAL des éléments sous le convoyeur (si différent du RAL affaire)
     */
    public function getRalUnderConveyor() {
        return $this->ralUnderConveyor;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Conveyor/ralUnderConveyor:property"}}{{/crossLink}}
     * @method setRalUnderConveyor
     * @param {String} newRalUnderConveyor 
     */
    public function setRalUnderConveyor($newRalUnderConveyor) {
        $this->ralUnderConveyor = $newRalUnderConveyor;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Conveyor/position:property"}}{{/crossLink}}
     * @method getPosition
     * @return {Integer} Position du convoyeur
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Conveyor/position:property"}}{{/crossLink}}
     * @method setPosition
     * @param {Integer} newPosition Nouvelle position du convoyeur
     */
    public function setPosition($newPosition) {
        $this->position = $newPosition;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Conveyor/options:property"}}{{/crossLink}}
     * @method getOptions
     * @return {Integer[]} Options du convoyeur
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Conveyor/options:property"}}{{/crossLink}}
     * @method setOptions
     * @param {Integer[]} newPosition Nouvelles options du convoyeur
     */
    public function setOptions($newOptions) {
        $this->options = $newOptions;
    }

}
