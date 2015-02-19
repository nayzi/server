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
 * Contient les méthodes de gestion des logs
 * @class Log
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class Log extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'Logs';

    /**
     * ID du log
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * Date d'occurence du log au format ISO-8601
     * @property date
     * @protected
     * @type string
     */
    protected $date;

    /**
     * Titre du log (semblable à un type)
     * @property title
     * @protected
     * @type string
     * @default
     */
    protected $title = "";

    /**
     * Description du log
     * @property desc
     * @protected
     * @type string
     * @beta
     */
    protected $desc = "";

    /**
     * Nom et prénom de l'utilisateur ayant créé le log
     * @property username
     * @protected
     * @type string
     */
    protected $username = "";

    /**
     * Crée un nouveau log (affecte la BDD)
     * @method create
     * @static
     * @param {String} title Titre du log
     * @param {String} desc Description du log
     * @param {String} orderId ID du bon de commande concerné
     * @return {Logics.Response}
     */
    public static function create($title, $desc, $orderId) {
        
    }

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'title' => $this->title,
            'desc' => $this->desc,
            'username' => $this->username,
            'date' => date('c', strtotime($this->date))
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Log/id:property"}}{{/crossLink}}
     * @method getId
     * @return {String} Date d'occurrence du log au format ISO-8601
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Log/id:property"}}{{/crossLink}}
     * @method setId
     * @param {String} newId Nouvel ID pour le log
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Log/date:property"}}{{/crossLink}}
     * @method getDate
     * @return {String} Date d'occurrence au format ISO-8601
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Log/date:property"}}{{/crossLink}}
     * @method setDate
     * @param {String} newDate Nouvelle date d'occurrence au format ISO-8601
     */
    public function setDate($newDate) {
        $this->date = $newDate;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Log/title:property"}}{{/crossLink}}
     * @method getTitle
     * @return {String} Titre du log
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Log/title:property"}}{{/crossLink}}
     * @method setTitle
     * @param {String} newTitle Nouveau titre du log
     */
    public function setTitle($newTitle) {
        $this->title = $newTitle;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Log/desc:property"}}{{/crossLink}}
     * @method getDesc
     * @beta
     * @return {String} Description de l'évènement
     */
    public function getDesc() {
        return $this->desc;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Log/desc:property"}}{{/crossLink}}
     * @method setDesc
     * @beta
     * @param {String} newDesc Nouvelle description du log
     */
    public function setDesc($newDesc) {
        $this->desc = $newDesc;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Log/username:property"}}{{/crossLink}}
     * @method getUsername
     * @return {String} Nom et prénom de l'utilisateur
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Log/username:property"}}{{/crossLink}}
     * @method setUsername
     * @param {String} newUsername Nouveau nom et prénom d'utilisateur
     */
    public function setUsername($newUsername) {
        $this->username = $newUsername;
    }

}
