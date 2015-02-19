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
 * Contient les méthodes de gestion d'un utilisateur
 * @class User
 * @constructor
 * @extends Logics.Item
 * @uses Utils.JsonSerializable
 * @namespace Logics
 */
class User extends Item implements \JsonSerializable {
    // Ecrase la variable $itemTable de la classe Item
    protected static $itemTable = 'Users';

    /**
     * Description of the property id.
     * @property id
     * @protected
     * @type integer
     * @default 0
     */
    protected $id = 0;

    /**
     * Description of the property username.
     * @property username
     * @protected
     * @type string
     * @default
     */
    protected $username = "";

    /**
     * Description of the property rights.
     * @property rights
     * @protected
     * @type integer[]
     * @default []
     */
    protected $rights = array();

    /**
     * Description of the property actions.
     * @property actions
     * @protected
     * @type integer[]
     * @default []
     */
    protected $actions = array();

    // Ecrase la méthode getItem de la classe Item
    public static function getItem($id = false) {
        // Retourne l'utilisateur loggé si l'ID correspond
        if (Session::hasAccess() && $id == Session::getUser()->getId()) {
            $result = new Response();
            $user = Session::getUser();
            
            if ($user->getId() > 0) {
                $result->setData($user);
                $result->setResult(TRUE);
            } else {
                $result->addError(200);
            }
        } else {
            $result = parent::getItem($id);
        }

        return $result;
    }

    /**
     * Met à jour un utilisateur (affecte la BDD)
     * @method update
     * @param {Integer} userId 
     * @param {String} username 
     * @param {array} rights 
     * @return {Logics.Response}
     */
    public static function update($userId, $username, $rights) {
        // @todo
        $result = new Response();

        return $result;
    }

    /**
     * 
     */
    public function __construct() {
        if (!is_array($this->rights)) {
            $this->rights = is_null($this->rights) ? array() : explode(',', $this->rights);
        }

        if (!is_array($this->actions)) {
            $this->actions = is_null($this->actions) ? array() : explode(',', $this->actions);
        }
    }

    // Implémentation de la méthode jsonSerialize de l'interface JsonSerializable
    public function jsonSerialize() {
        return array(
            "id" => $this->id,
            "username" => $this->username,
            "rights" => $this->rights,
            "actions" => $this->actions
        );
    }

    /**
     * Retourne l'ID de l'utilisateur
     * @method getId
     * @return {Integer} id ID de l'utilisateur
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Met à jour l'ID de l'utilisateur
     * @method setId
     * @param {Integer} newId Nouvel ID de l'utilisateur
     */
    public function setId($newId) {
        $this->id = $newId;
    }

    /**
     * Retourne le nom et prénom de l'utilisateur
     * @method getUsername
     * @return {String} username Nom et prénom de l'utilisateur
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Met à jour le nom et prénom de l'utilisateur
     * @method setUsername
     * @param {String} newUsername Nouveau nom et prénom de l'utilisateur
     */
    public function setUsername($newUsername) {
        $this->username = $newUsername;
    }

    /**
     * Retourne un tableau contenant l'ID des droits appliqués à l'utilisateur
     * @method getRights
     * @return {Integer[]} rights ID des droits appliqués à l'utilisateur
     */
    public function getRights() {
        return $this->rights;
    }

    /**
     * Met à jour les droits appliqués à l'utilisateur
     * @method setRights
     * @param {Integer[]} newRights ID des nouveaux droits
     */
    public function setRights($newRights) {
        $this->rights = $newRights;
    }

    /**
     * Retourne l'ID des évènements associés à l'utilisateur
     * @method getActions
     * @return {Integer[]} actions ID des évènements
     */
    public function getActions() {
        return $this->actions;
    }

    /**
     * Met à jour la liste des évènements associés à l'utilisateur
     * @method setActions
     * @param {Integer[]} newActions ID des nouveaux
     */
    public function setActions($newActions) {
        $this->actions = $newActions;
    }

}
