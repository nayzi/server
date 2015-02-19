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
 * Permet à un webservice de créer un objet
 * @class ItemCreatable
 * @extends API.Item
 * @static
 * @namespace API
 */
interface ItemCreatable extends Item {

    /**
     * Crée un item dans la base de donnée
     * @method create
     * @static
     * @return {JsonSerializable}
     */
    public static function create();
}
