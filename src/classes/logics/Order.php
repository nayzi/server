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
 * @class Order
 * @constructor
 * @extends Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class Order extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'Orders';

    /**
     * ID du bon de commande
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * ID de l'affaire liée
     * @property deal
     * @protected
     * @type integer
     * @default 0
     */
    protected $deal = 0;

    /**
     * ID du type de convoyeur
     * @property conveyorType
     * @protected
     * @type integer
     * @default 0
     */
    protected $conveyorType = 0;

    /**
     * ID du climat
     * @property climat
     * @protected
     * @type integer
     * @default 0
     */
    protected $climat = 0;

    /**
     * Numéro OTP
     * @property OTP
     * @protected
     * @type string
     * @default 
     */
    protected $otp = "";

    /**
     * Nom du dessinateur
     * @property drawerName
     * @protected
     * @type string
     * @default null
     */
    protected $drawerName = null;

    /**
     * Numéro de plan
     * @property plan
     * @protected
     * @type string
     * @default 
     */
    protected $plan = "";

    /**
     * Nom et prénom de l'utilisateur ayant créé le bon de commande
     * @property createdBy
     * @protected
     * @type string
     * @default 
     */
    protected $createdBy = "";

    /**
     * Date de création du bon de commande (format de la BDD)
     * @property createdAt
     * @protected
     * @type string
     * @default 
     */
    protected $createdAt = "";

    /**
     * Nom et prénom du dernière utilisateur ayant modifié le bon de commande
     * @property lastEditedBy
     * @protected
     * @type string
     * @default 
     */
    protected $lastEditedBy = "";

    /**
     * Date de dernière modification du bon de commande (format de la BDD)
     * @property lastEditedAt
     * @protected
     * @type string
     * @default 
     */
    protected $lastEditedAt = "";

    /**
     * Liste des convoyeurs associés à ce bon de commande
     * @property conveyors
     * @protected
     * @type integer[]
     * @default []
     */
    protected $conveyors = array();

    /**
     * Liste des pièces associés à ce bon de commande
     * @property orderPieces
     * @protected
     * @type integer[]
     * @default []
     */
    protected $orderPieces = array();

    /**
     * Liste des options associés à ce bon de commande
     * @property options
     * @protected
     * @type integer[]
     * @default []
     */
    protected $options = array();

    /**
     * Vérouille un bon de commande
     * @method lock
     * @static
     * @param {Integer} orderId ID du bon de commmande
     * @return {Logics.Response}
     */
    public static function lock($orderId) {
        
    }

    /**
     * Dévérouille un bon de commande
     * @method unlock
     * @static
     * @param {Integer} orderId ID du bon de commande
     * @return {Logics.Response}
     */
    public static function unlock($orderId) {
        
    }

    /**
     * Vérifie si le bon de commande est vérouillé
     * @method isLocked
     * @static
     * @param {Integer} orderId ID du bon de commande
     * @return {Logics.Response}
     */
    public static function isLocked($orderId) {
        
    }

    /**
     * Crée un bon de commande (affecte la BDD)
     * @method create
     * @static
     * @param {Integer} dealId ID de l'affaire
     * @param {Integer} conveyorTypeId ID du type de convoyeur
     * @param {Integer} climatId ID du climat
     * @param {String} OTP Numéro OTP
     * @param {String} drawerName Nom du dessinateur
     * @param {String} plan Numéro de plan
     * @return {Logics.Response}
     */
    public static function create($dealId, $conveyorTypeId, $climatId, $otp, $drawerName, $plan) {
        $result = new Response();

        $newId = \DB\DBInterface::get()->execute('call Orders_create(:id, :deal, :conveyorType, :climat, :otp, :drawerName, :plan);', array(
            ':id' => Session::getUser()->getId(), ':deal' => $dealId, ':conveyorType' => $conveyorTypeId, ':climat' => $climatId,
            ':otp' => $otp, ':drawerName' => $drawerName, ':plan' => $plan
        ));

        if ($newId['id'] > 0) {
            $order = \DB\DBInterface::get()->one('call Orders_getItem(:id);', array(':id' => $newId['id']), '\Logics\Order');
            
            $result->setResult(TRUE);
            $result->setData($order);
            
            \Logics\Log::create('BDC créée', 'Création du BDC n°ORDER_'.$newId['id'], $newId['id']);
        } else {
            $result->addError(300);
        }

        return $result;
    }

    /**
     * Met à jour un bon de commande (affecte la BDD)
     * @method update
     * @static
     * @param {Integer} orderId ID du bon de commande
     * @param {Integer} climatId ID du climat
     * @param {String} OTP Numéro OTP
     * @param {String} drawerName Nom du dessinateur
     * @param {String} plan Numéro de plan
     * @return {Logics.Response}
     */
    public static function update($orderId, $climatId, $otp, $drawerName, $plan) {
        
    }

    /**
     * Supprime un bon de commande (affecte la BDD)
     * @method delete
     * @static
     * @param {Integer} orderId ID du bon de commande
     * @return {Logics.Response}
     */
    public static function delete($orderId) {
        
    }
    
    public function __construct() {
        if (!is_array($this->conveyors)) {
            $this->conveyors = is_null($this->conveyors) ? array() : explode(',', $this->conveyors);
        }
        
        if (!is_array($this->orderPieces)) {
            $this->orderPieces = is_null($this->orderPieces) ? array() : explode(',', $this->orderPieces);
        }
        
        if (!is_array($this->options)) {
            $this->options = is_null($this->options) ? array() : explode(',', $this->options);
        }
    }

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'deal' => $this->deal,
            'conveyorType' => $this->conveyorType,
            'climat' => $this->climat,
            'otp' => $this->otp,
            'drawerName' => $this->drawerName,
            'plan' => $this->plan,
            'createdBy' => $this->createdBy,
            'createdAt' => Utils::getDate($this->createdAt),
            'lastEditedBy' => $this->lastEditedBy,
            'lastEditedAt' => Utils::getDate($this->lastEditedAt),
            'conveyors' => $this->conveyors,
            'options' => $this->options,
            'orderPieces' => $this->orderPieces
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Order/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID du bon de commande
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Order/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID du bon de commande
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Order/deal:property"}}{{/crossLink}}
     * @method getDeal
     * @return {Integer} ID du bon de commande
     */
    public function getDeal() {
        return $this->deal;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Order/deal:property"}}{{/crossLink}}
     * @method setDeal
     * @param {Integer} newDeal Nouvel ID de l'affaire liée
     */
    public function setDeal($newDeal) {
        $this->deal = $newDeal;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Order/conveyorType:property"}}{{/crossLink}}
     * @method getConveyorType
     * @return {Integer} ID du type de convoyeur
     */
    public function getConveyorType() {
        return $this->conveyorType;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Order/conveyorType:property"}}{{/crossLink}}
     * @method setConveyorType
     * @param {Integer} newConveyorType Nouvel ID du type de convoyeur
     */
    public function setConveyorType($newConveyorType) {
        $this->conveyorType = $newConveyorType;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Order/climat:property"}}{{/crossLink}}
     * @method getClimat
     * @return {Integer} ID du climat
     */
    public function getClimat() {
        return $this->climat;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Order/climat:property"}}{{/crossLink}}
     * @method setClimat
     * @param {Integer} newClimat Nouvel ID du climat
     */
    public function setClimat($newClimat) {
        $this->climat = $newClimat;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Order/OTP:property"}}{{/crossLink}}
     * @method getOTP
     * @return {String} Numéro OTP 
     */
    public function getOTP() {
        return $this->otp;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Order/OTP:property"}}{{/crossLink}}
     * @method setOTP
     * @param {String} newOTP Nouveau numéro OTP
     */
    public function setOTP($newOTP) {
        $this->otp = $newOTP;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Order/drawerName:property"}}{{/crossLink}}
     * @method getDrawerName
     * @return {String} Nom et prénom du dessinateur
     */
    public function getDrawerName() {
        return $this->drawerName;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Order/drawerName:property"}}{{/crossLink}}
     * @method setDrawerName
     * @param {String} newDrawerName Nouveau nom et prénom du dessinateur
     */
    public function setDrawerName($newDrawerName) {
        $this->drawerName = $newDrawerName;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Order/plan:property"}}{{/crossLink}}
     * @method getPlan
     * @return {String} Numéro de plan
     */
    public function getPlan() {
        return $this->plan;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Order/plan:property"}}{{/crossLink}}
     * @method setPlan
     * @param {String} newPlan Nouveau numéro de plan
     */
    public function setPlan($newPlan) {
        $this->plan = $newPlan;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Order/createdBy:property"}}{{/crossLink}}
     * @method getCreatedBy
     * @return {String} Nom et prénom de l'utilisateur ayant créé le bon de commande
     */
    public function getCreatedBy() {
        return $this->createdBy;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Order/createdBy:property"}}{{/crossLink}}
     * @method setCreatedBy
     * @param {String} newCreatedBy Nouveau nom et prénom de l'utilisateur ayant créé le bon de commande
     */
    public function setCreatedBy($newCreatedBy) {
        $this->createdBy = $newCreatedBy;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Order/createdAt:property"}}{{/crossLink}}
     * @method getCreatedAt
     * @return {String} Date de création au format ISO-8601
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Order/createdAt:property"}}{{/crossLink}}
     * @method setCreatedAt
     * @param {String} newCreatedAt Nouvelle date de création au format ISO-8601
     */
    public function setCreatedAt($newCreatedAt) {
        $this->createdAt = $newCreatedAt;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Order/lastEditedBy:property"}}{{/crossLink}}
     * @method getLastEditedBy
     * @return {String} Nom et prénom de l'utilisateur ayant fait la dernière modification
     */
    public function getLastEditedBy() {
        return $this->lastEditedBy;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Order/lastEditedBy:property"}}{{/crossLink}}
     * @method setLastEditedBy
     * @param {String} newLastEditedBy Nouveau nom et prénom de l'utilisateur ayant fait la dernière modification
     */
    public function setLastEditedBy($newLastEditedBy) {
        $this->lastEditedBy = $newLastEditedBy;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Order/lastEditedAt:property"}}{{/crossLink}}
     * @method getLastEditedAt
     * @return {String} Date de dernière modification au format ISO-8601
     */
    public function getLastEditedAt() {
        return $this->lastEditedAt;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Order/lastEditedAt:property"}}{{/crossLink}}
     * @method setLastEditedAt
     * @param {String} newLastEditedAt Nouvelle date de dernière modification au format ISO-8601
     */
    public function setLastEditedAt($newLastEditedAt) {
        $this->lastEditedAt = $newLastEditedAt;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Order/conveyors:property"}}{{/crossLink}}
     * @method getConveyors
     * @return {Integer[]} Liste des convoyeurs associés au bon de commande
     */
    public function getConveyors() {
        return $this->conveyors;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Order/conveyors:property"}}{{/crossLink}}
     * @method setConveyors
     * @param {Integer[]} newConveyors Nouvelle liste des convoyeurs associés au bon de commande
     */
    public function setConveyors($newConveyors) {
        $this->conveyors = $newConveyors;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Order/options:property"}}{{/crossLink}}
     * @method getOptions
     * @return {Integer[]} Liste des options associés au bon de commande
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Order/options:property"}}{{/crossLink}}
     * @method setOptions
     * @param {Integer[]} newOptions Nouvelle liste des options associés au bon de commande
     */
    public function setOptions($newOptions) {
        $this->options = $newOptions;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Order/orderPieces:property"}}{{/crossLink}}
     * @method getOrderPieces
     * @return {Integer[]} Liste des pièces associés au bon de commande
     */
    public function getOrderPieces() {
        return $this->orderPieces;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Order/orderPieces:property"}}{{/crossLink}}
     * @method setOrderPieces
     * @param {Integer[]} newOrderPieces Nouvelle liste des pièces associés au bon de commande
     */
    public function setOrderPieces($newOrderPieces) {
        $this->orderPieces = $newOrderPieces;
    }

}
