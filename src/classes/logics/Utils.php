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
class Utils {
    /**
     * Vérifie si un enregistrement existe
     * @param {String} type
     * @param {String[]} args
     * @return {Logics.Response}
     */
    public static function recordExists($type, $args) {
        $result = new Response();
        $table = ucfirst($type) . 's';
        $params = array();
        $where = '';

        foreach ($args as $k => $v) {
            $params = array_merge($params, array(':' . $k => $v));
            $where .= $k . ' =  :' . $k . ' AND ';
        }

        if (strlen($where) == 0) {
            return $result;
        }

        $query = \DB\DBInterface::get()->one('SELECT IF (EXISTS('
                . 'SELECT * FROM ' . $table . ' WHERE ' . substr($where, 0, -5)
                . '), 1, 0) as "exists";', $params);

        $result->setResult(TRUE);
        $result->setData((boolean) $query['exists']);

        return $result;
    }
    
    /**
     * Convertit une date en date au format ISO-8601
     * @param {String} strDate Date dans un format compréhensible pour la fonction
     * `strtotime`
     * @return {String} Date au format ISO-8601
     */
    public static function getDate($strDate) {
        return date('c', strtotime($strDate));
    }
}
