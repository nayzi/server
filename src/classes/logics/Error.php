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
 * Contient les méthodes de gestion des erreurs
 * @class Error
 * @constructor __construct
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class Error implements \JsonSerializable {

    /**
     * Numéro de l'erreur
     * @property number
     * @protected
     * @type integer
     * @default 0
     */
    protected $number = 0;

    /**
     * Type de l'erreur
     * @property type
     * @protected
     * @type string
     * @default
     */
    protected $type = "";

    /**
     * Message associé à l'erreur
     * @property message
     * @protected
     * @type string
     * @default
     */
    protected $message = "";

    /**
     * Crée une erreur avec les paramètres suivants
     * @method __contruct
     * @constructor
     * @param {Integer} number Numéro de l'erreur
     * @param {String} type Type de l'erreur
     * @param {String} message Message de l'erreur
     */
    public function __construct($number, $type, $message) {
        $this->number = $number;
        $this->type = $type;
        $this->message = $message;
    }

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            'number' => $this->number,
            'type' => $this->type,
            'message' => $this->message
        );
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Error/number:property"}}{{/crossLink}}
     * @method getNumber
     * @return {Integer} Numéro de l'erreur
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Error/type:property"}}{{/crossLink}}
     * @method getType
     * @return {String}
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Error/message:property"}}{{/crossLink}}
     * @method getMessage
     * @return {String} Message associé à l'erreur 
     */
    public function getMessage() {
        return $this->message;
    }

}
