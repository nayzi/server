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
 * Contient la description de l'objet retourné par la méthode {{#crossLink "Session/connect:method"}}{{#crossLink}} ou {{#crossLink "Session/restore:method"}}{{#crossLink}}
 * @class UserInfo
 * @constructor
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class UserInfo implements \JsonSerializable {

    /**
     * ID de l'utilisateur
     * @property id
     * @protected
     * @type {integer}
     * @default
     */
    protected $id = "";

    /**
     * Clé d'identification
     * @property token
     * @protected
     * @type {string}
     * @default
     */
    protected $token = "";

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'token' => $this->token
        );
    }

    /**
     * Retourne la propriété {{#crossLink "ADInterface.UserInfo/id:property"}}{{/crossLink}}
     * @method getId
     * @return {Integer} ID de l'utilisateur
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour la propriété {{#crossLink "ADInterface.UserInfo/id:property"}}{{/crossLink}}
     * @method setId
     * @param {Integer} newId Nouvel ID de l'utilisateur
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne la propriété {{#crossLink "ADInterface.UserInfo/token:property"}}{{/crossLink}}
     * @method getToken
     * @return {String} Clé d'identification
     */
    public function getToken() {
        return $this->token;
    }

    /**
     * Met à jour la propriété {{#crossLink "ADInterface.UserInfo/token:property"}}{{/crossLink}}
     * @method setToken
     * @param {Integer} newToken Nouvelle clé d'identification
     */
    public function setToken($newToken) {
        $this->token = $newToken;
    }

}
