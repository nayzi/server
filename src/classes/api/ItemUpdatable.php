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
 * Permet à un webservice de mettre à jour un objet
 * @class ItemUpdatable
 * @extends API.Item
 * @static
 * @namespace API
 */
interface ItemUpdatable extends Item {

    /**
     * Met à jour un item dans la base de donnée
     * @method update
     * @static
     * @return {JsonSerializable}
     */
    public static function update($itemId);
}
