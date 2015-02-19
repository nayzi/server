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
 * Contient les méthodes de gestion des évènements
 * @class Action
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class Action extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'Actions';

    /**
     * ID de l'évènement
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * Date d'occurrence de l'évènement au format ISO-8601
     * @property date
     * @protected
     * @type string
     * @default
     */
    protected $date = "";

    /**
     * Titre de l'évènement (semblable à un type)
     * @property title
     * @protected
     * @type string
     * @default
     */
    protected $title = "";

    /**
     * Description de l'évènement
     * @property desc
     * @protected
     * @type string
     * @beta
     */
    protected $desc = "";

    /**
     * Crée un nouvel évènement (affecte la BDD)
     * @method create
     * @static
     * @param {String} title Titre de l'évènement
     * @param {String} desc Description de l'évènement
     */
    public static function create($title, $desc = null) {
        \DB\DBInterface::get()->execute('call Actions_create(:userId, :title, :desc);', array(
            ':userId' => Session::getUser()->getId(),
            ':title' => $title,
            ':desc' => $desc
        ));
    }

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'title' => $this->title,
            'desc' => $this->desc,
            'date' => date('c', strtotime($this->date))
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Action/id:property"}}{{/crossLink}}
     * @method getId
     * @return {String} Date d'occurrence de l'évènement au format ISO-8601
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Action/id:property"}}{{/crossLink}}
     * @method setId
     * @param {String} newId Nouvel ID pour l'évènement
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Action/date:property"}}{{/crossLink}}
     * @method getDate
     * @return {String} Date d'occurrence au format ISO-8601
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Action/date:property"}}{{/crossLink}}
     * @method setDate
     * @param {String} newDate Nouvelle date d'occurrence au format ISO-8601
     */
    public function setDate($newDate) {
        $this->date = $newDate;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Action/title:property"}}{{/crossLink}}
     * @method getTitle
     * @return {String} Titre de l'évènement
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Action/title:property"}}{{/crossLink}}
     * @method setTitle
     * @param {String} newTitle Nouveau titre de l'évènement
     */
    public function setTitle($newTitle) {
        $this->title = $newTitle;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Action/desc:property"}}{{/crossLink}}
     * @method getDesc
     * @beta
     * @return {String} Description de l'évènement
     */
    public function getDesc() {
        return $this->desc;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Action/desc:property"}}{{/crossLink}}
     * @method setDesc
     * @beta
     * @param {String} newDesc Nouvelle description de l'évènement
     */
    public function setDesc($newDesc) {
        $this->desc = $newDesc;
    }

}
