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
 * Permet à un webservice de supprimer un objet
 * @class ItemDeletable
 * @extends API.Item
 * @static
 * @namespace API
 */
interface ItemDeletable extends Item {

    /**
     * Supprime un item dans la base de donnée
     * @method delete
     * @static
     * @return {JsonSerializable}
     */
    public static function delete($itemId);
}
