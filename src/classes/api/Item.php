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
 * Regroupe les webservices de récupération d'élément
 * @class Item
 * @static
 * @namespace API
 */
interface Item {

    /**
     * Retourne l'enregistrement correspondant à l'ID passé en paramètre
     * @method getItem
     * @static
     * @param {Integer} itemId ID de l'item
     * @return {JsonSerializable}
     */
    public static function getItem($itemId);

    /**
     * Retourne la liste des items
     * @method getItems
     * @static
     * @return {JsonSerializable}
     */
    public static function getItems();
}
