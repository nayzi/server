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
 * Contient les méthodes de vérification de la BDD nécessaire au fonctionnement de
 * {{#crossLink "API.Utils"}}{{/crossLink}} ainsi que les méthodes de récupération
 * d'élément
 * 
 * @class Utils
 * @static
 * @namespace Logics
 */
class Item {

    /**
     * Nom de la table contenant les informations de l'objet
     * @property itemTable
     * @static
     * @protected
     * @type {String}
     */
    protected static $itemTable = NULL;

    /**
     * Retourne un ou plusieurs élément du type {{crossLink "Logics.Item/itemTable:property"}}{{/crossLink}}
     * correspondant à/aux id(s)
     * @param {Integer|Integer[]|FALSE} id Id de l'élément à retourné ou liste d'élément
     * @return {Logics.Response}
     */
    public static function getItem($id = false) {
        $result = new Response();

        if (!$id || is_array($id)) {
            $data = self::getItems($id);

            if (count($data) > 0) {
                $result->setData(is_array($data) ? $data : array($data));
                $result->setResult(TRUE);
            }
        } else {
            $item = \DB\DBInterface::get()->one(
                    'call ' . static::$itemTable . '_getItem(:id);', array(':id' => $id), get_called_class()
            );

            if ($item->getId() > 0) {
                $result->setData($item);
                $result->setResult(TRUE);
            }
        }

        if (!$result->isValid()) {
            $result->addError(200);
        }

        return $result;
    }

    /**
     * Retourne la liste des éléments de type `type`.
     * Si le paramètre `ids` est utilisé, la méthode ne retournera que les éléments
     * correspondant aux ids passés en paramètre. Dans le cas inverse, tous les
     * éléments sont retournés.
     * @param {String} type Nom de l'objet
     * @param {Integer[]|FALSE} ids Liste d'id des éléments à retourner
     * @protected
     * @return {Object[]}
     */
    protected static function getItems($ids = false) {
        $data = array();

        if (!$ids) {
            $data = \DB\DBInterface::get()->all('call ' . static::$itemTable . '_getItems();', array(), get_called_class());
        } else {
            $data = \DB\DBInterface::get()->all('call ' . static::$itemTable . '_getItemsByIds(:ids);', array(':ids' => self::toSql($ids)), get_called_class());
        }

        return $data;
    }

    /**
     * Transforme un tableau d'id en chaîne de caractère
     * @param {Integer[]} array Liste des ids
     * @private
     * @return {String} Les ids séparés par des `,`
     */
    private static function toSql($array) {
        $str = '';

        foreach ($array as $v) {
            $str .= $v . ',';
        }

        return substr($str, 0, -1);
    }

}
