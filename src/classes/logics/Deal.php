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
 * Contient les méthodes de gestion des affaires
 * @class Deal
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class Deal extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'Deals';

    /**
     * ID de l'affaire
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * Numéro de l'affaire
     * @property number
     * @protected
     * @type string
     * @default
     */
    protected $number = "";

    /**
     * Nom de l'affaire
     * @property dealName
     * @protected
     * @type string
     * @default null
     */
    protected $dealName = NULL;

    /**
     * Entre-guide de l'affaire
     * @property eg
     * @protected
     * @type integer
     * @default 0
     */
    protected $eg = 0;

    /**
     * Nom du client
     * @property clientName
     * @protected
     * @type string
     * @default null
     */
    protected $clientName = NULL;

    /**
     * Code couleur RAL des convoyeurs
     * @property ral
     * @protected
     * @type string
     * @default
     */
    protected $ral = "";

    /**
     * Code couleur RAL des éléments sous les convoyeurs
     * @property ralUnderConveyor
     * @protected
     * @type string
     * @default
     */
    protected $ralUnderConveyor = "";

    /**
     * Nom et prénom du créateur de l'affaire
     * @property createdBy
     * @protected
     * @type string
     * @default
     */
    protected $createdBy = "";

    /**
     * Date de création de l'affaire (format de la BDD)
     * @property createdAt
     * @protected
     * @type string
     */
    protected $createdAt = "";

    /**
     * Liste des ID des bons de commande de l'affaire
     * @property orders
     * @protected
     * @type integer[]
     * @default []
     */
    protected $orders = array();

    /**
     * Crée une nouvelle affaire (affecte la BDD)
     * @method create
     * @static
     * @param {String} number Numéro de l'affaire
     * @param {String} dealName Nom de l'affaire
     * @param {Integer} eg Entre-guide des convoyeurs de l'affaire
     * @param {String} clientName Nom du client
     * @param {String} ral Code couleur RAL des convoyeurs
     * @param {String} ralUnderConveyor Code couleur RAL des éléments sous les convoyeurs
     * @return {Logics.Response}
     */
    public static function create($number, $dealName, $eg, $clientName, $ral, $ralUnderConveyor) {
        $result = new Response();

        $newId = \DB\DBInterface::get()->execute('call Deals_create(:id, :number, :name, :eg, :clientName, :ral, :ralU);', array(
            ':id' => Session::getUser()->getId(), ':number' => $number, ':name' => $dealName, ':eg' => $eg,
            ':clientName' => $clientName, ':ral' => $ral,
            ':ralU' => $ralUnderConveyor
        ));

        if ($newId['id'] > 0) {
            $deal = \DB\DBInterface::get()->one('call Deals_getItem(:id);', array(':id' => $newId['id']), '\Logics\Deal');
            
            $result->setResult(TRUE);
            $result->setData($deal);
            
            \Logics\Action::create('Affaire créée', 'Création de l\'affaire n°DEAL_'.$newId['id']);
        } else {
            $result->addError(300);
        }

        return $result;
    }

    /**
     * Met à jour une affaire (affecte la BDD)
     * @method update
     * @static
     * @param {Integer} dealId ID de l'affaire à mettre à jour
     * @param {String} dealName Nom de l'affaire
     * @param {String} clientName Nom du client
     * @param {String} ral Code couleur RAL des convoyeurs
     * @param {String} ralUnderConveyor Code couleur RAL des éléments sous les convoyeurs
     * @return {Logics.Response}
     */
    public static function update($dealId, $dealName, $clientName, $ral, $ralUnderConveyor) {
        $result = new Response();

        $nbRows = \DB\DBInterface::get()->execute('call Deals_update(:id, :name, :clientName, :ral, :ralU);', array(
            ':id' => $dealId, ':name' => $dealName, ':clientName' => $clientName,
            ':ral' => $ral, ':ralU' => $ralUnderConveyor
        ));

        if ($nbRows > 0) {
            $deal = \DB\DBInterface::get()->one('call Deals_getItem(:id);', array(':id' => $dealId), '\Logics\Deal');
            
            $result->setResult(TRUE);
            $result->setData($deal);
            
            \Logics\Action::create('Affaire éditée', 'Edition de l\'affaire n°DEAL_'.$dealId);
        } else {
            $result->addError(400);
        }

        return $result;
    }

    /**
     * Supprimer une affaire
     * @method delete
     * @static
     * @param {Integer} dealId ID de l'affaire à supprimer
     * @return {Logics.Response}
     */
    public static function delete($dealId) {
        

        \DB\DBInterface::get()->execute('call delete_deal(:p_id);', array(
            ':p_id' => $dealId
        ));

        
        
    }
    
    /**
     * Répare le type des données lors d'une construction via PDO
     * @method __construct
     */
    public function __construct() {
        if (!is_array($this->orders)) {
            $this->orders = is_null($this->orders) ? array() : explode(',', $this->orders);
        }
    }

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'number' => $this->number,
            'dealName' => $this->dealName,
            'eg' => $this->eg,
            'clientName' => $this->clientName,
            'ral' => $this->ral,
            'ralUnderConveyor' => $this->ralUnderConveyor,
            'orders' => $this->orders,
            'createdBy' => $this->createdBy,
            'createdAt' => Utils::getDate($this->createdAt)
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Deal/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID de l'affaire
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Deal/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID de l'affaire
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Deal/number:property"}}{{/crossLink}}
     * @method getNumber
     * @return {String} Numéro de l'affaire
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Deal/number:property"}}{{/crossLink}}
     * @method setNumber
     * @param {String} newDealNumber Nouveau numéro de l'affaire
     */
    public function setNumber($newNumber) {
        $this->number = $newNumber;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Deal/dealName:property"}}{{/crossLink}}
     * @method getDealName
     * @return {String} Nom de l'affaire
     */
    public function getDealName() {
        return $this->dealName;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Deal/dealName:property"}}{{/crossLink}}
     * @method setDealName
     * @param {String} newDealName Nouveau nom de l'affaire
     */
    public function setDealName($newDealName) {
        $this->dealName = $newDealName;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Deal/eg:property"}}{{/crossLink}}
     * @method getEg
     * @return {Integer} Entre-guide des convoyeurs de l'affaire
     */
    public function getEg() {
        return $this->eg;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Deal/eg:property"}}{{/crossLink}}
     * @method setEg
     * @param {Integer} newEg Nouvel entre-guide pour les convoyeurs de l'affaire
     */
    public function setEg($newEg) {
        $this->eg = $newEg;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Deal/clientName:property"}}{{/crossLink}}
     * @method getClientName
     * @return {String} Nom du client
     */
    public function getClientName() {
        return $this->clientName;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Deal/clientName:property"}}{{/crossLink}}
     * @method setClientName
     * @param {String} newClientName Nouveau nom de client
     */
    public function setClientName($newClientName) {
        $this->clientName = $newClientName;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Deal/ral:property"}}{{/crossLink}}
     * @method getRal
     * @return {String} Code couleur RAL des convoyeurs de l'affaire
     */
    public function getRal() {
        return $this->ral;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Deal/ral:property"}}{{/crossLink}}
     * @method setRal
     * @param {String} newRal Nouveau code couleur RAL des convoyeurs de l'affaire
     */
    public function setRal($newRal) {
        $this->ral = $newRal;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Deal/ralUnderConveyor:property"}}{{/crossLink}}
     * @method getRalUnderConveyor
     * @return {String} Code couleur RAL des éléments sous les convoyeurs de l'affaire
     */
    public function getRalUnderConveyor() {
        return $this->ralUnderConveyor;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Deal/ralUnderConveyor:property"}}{{/crossLink}}
     * @method setRalUnderConveyor
     * @param {String} newRalUnderConveyor Nouveau code couleur RAL des éléments sous les convoyeurs de l'affaire
     */
    public function setRalUnderConveyor($newRalUnderConveyor) {
        $this->ralUnderConveyor = $newRalUnderConveyor;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Deal/createdBy:property"}}{{/crossLink}}
     * @method getCreatedBy
     * @return {String} Nom et prénom de l'utilisateur ayant créé l'affaire
     */
    public function getCreatedBy() {
        return $this->createdBy;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Deal/createdBy:property"}}{{/crossLink}}
     * @method setCreatedBy
     * @param {String} newCreatedBy Nouveau nom et prénom de l'utilisateur ayant créé l'affaire
     */
    public function setCreatedBy($newCreatedBy) {
        $this->createdBy = $newCreatedBy;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Deal/createdAt:property"}}{{/crossLink}}
     * @method getCreatedAt
     * @return {String} Date de création de l'affaire au format ISO-8601
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Deal/createdAt:property"}}{{/crossLink}}
     * @method setCreatedAt
     * @param {String} newCreatedAt Nouvelle date de création de l'affaire au format ISO-8601
     */
    public function setCreatedAt($newCreatedAt) {
        $this->createdAt = $newCreatedAt;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Deal/orders:property"}}{{/crossLink}}
     * @method getOrders
     * @return {Integer[]} Liste des ID des bons de commande associés à l'affaire
     */
    public function getOrders() {
        return $this->orders;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Deal/orders:property"}}{{/crossLink}}
     * @method setOrders
     * @param {Integer[]} newOrders Nouvelle liste des ID des bons de commande associés à l'affaire
     */
    public function setOrders($newOrders) {
        $this->orders = $newOrders;
    }

}
