<?php

namespace API;

// Make sure we don't directly access the file
if (!defined("IS_SECURE") || !IS_SECURE)
    die('I don\'t like you');
/*
 * @license PASC Client - Fives
 * Available via the MIT or new BSD license.
 */

/**
 * @module API
 */

/**
 * Sert à encapsuler les données
 * @class Wrapper
 * @uses Utils.JsonSerializable
 * @namespace API
 */
class Wrapper implements \JsonSerializable {

    /**
     * Nom de l'objet à encapsuler
     * @property name
     * @protected
     * @type string
     */
    protected $name;

    /**
     * Objet à encapsuler
     * @property value
     * @protected
     * @type Any
     */
    protected $value;

    /**
     * 
     * @method __construct
     * @constructor
     * @param {String} name Nom de l'objet à encapsuler
     * @param {Any} value Objet à encapsuler
     */
    public function __construct($name, $value) {
        $this->name = $name;
        $this->value = $value;
    }

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array($this->name => \Utils::patchJson($this->value));
    }

}
