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
 * Défini l'objet de retour des opérations du module {{#crossLink "Logics"}}{{/crossLink}}
 * @class Response
 * @constructor
 * @namespace Logics
 */
class Response {

    /**
     * Données retournées en cas de succès
     * @property data
     * @protected
     * @type {Any}
     * @default null
     */
    protected $data = NULL;

    /**
     * Liste des erreurs ayant eu lieu au cour du processus
     * @property errors
     * @protected
     * @type {Logics.Error[]}
     * @default []
     */
    protected $errors = array();

    /**
     * Indique si l'opération a été un succès ou non
     * @property result
     * @protected
     * @type {Boolean}
     * @default false
     */
    protected $result = false;

    /**
     * Ajoute l'erreur n°`errNo` à l'objet de réponse
     * @method addError
     * @param {Integer} errNo 
     */
    public function addError($errNo) {
        array_push($this->errors, ErrorMessage::get($errNo));
    }

    /**
     * Met à jour le résultat de l'opération
     * @method setResult
     * @param {Boolean} result
     */
    public function setResult($result) {
        $this->result = $result;
    }

    /**
     * Indique si l'opération a été un succès ou non
     * @method isValid
     * @return {Boolean} Validité de l'opération
     */
    public function isValid() {
        return $this->result;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Response/data:property"}}{{/crossLink}}
     * @method getData
     * @return {Any}
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Met à jour la propriété {{#crossLink "Logics.Response/data:property"}}{{/crossLink}}
     * @method setData
     * @param {Any} newData
     */
    public function setData($newData) {
        $this->data = $newData;
    }

    /**
     * Retourne la propriété {{#crossLink "Logics.Response/errors:property"}}{{/crossLink}}
     * @method getErrors
     * @return {Logics.Error[]} Liste des erreurs
     */
    public function getErrors() {
        return $this->errors;
    }

}
