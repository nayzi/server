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
 * Regroupe les webservices relatifs aux utilisateurs
 * @class User
 * @static
 * @uses API.ItemUpdatable
 * @namespace API
 */
class User implements ItemUpdatable {

    /**
     * Connecte un utilisateur
     * @method connect
     * @static
     * @return {JsonSerializable}
     */
    public static function connect() {
        $post = \Utils::getJsonInput();
        http_response_code(400);
        $result = '';

        if (isset($post['username']) && isset($post['password'])) {
            $connect = \Logics\Session::connect($post['username'], $post['password']);

            if ($connect->isValid()) {
                http_response_code(200);
                $result = $connect->getData();
            } else {
                $result = $connect->getErrors();
            }
        }

        return \Utils::patchJson($result);
    }

    /**
     * Déconnecte un utilisateur
     * @method disconnect
     * @static
     * @return {JsonSerializable}
     */
    public static function disconnect() {
        $result = \Logics\Session::disconnect();
        
        if (!$result->isValid()) {
            return \Utils::patchJson($result->getErrors());
        }
    }

    // Implémentation de la méthode update de la classe ItemUpdatable
    public static function update($itemId) {
        // @todo
        $username = '';
        $rights = array();
        
        return \Logics\User::update($itemId, $username, $rights);
    }

    // Implémentation de la méthode getItem de la classe Item
    public static function getItem($itemId) {
        if (!\Logics\Session::hasAccess()) {
            http_response_code(401);
            return;
        }
        
        $result = \Logics\User::getItem($itemId);

        if ($result->isValid()) {
            $data = new Wrapper('user', $result->getData());
        } else {
            $data = $result->getErrors();
        }

        return \Utils::patchJson($data);
    }

    // Implémentation de la méthode getItems de la classe Item
    public static function getItems() {
        $args = \Utils::parseGetParam();
        $arrayData = array();

        if (!\Logics\Session::hasAccess()) {
            http_response_code(401);
            return;
        }

        if (array_key_exists('ids', $args) && count($args['ids']) != 0) {
            $result = \Logics\User::getItem($args['ids']);
        } else {
            $result = \Logics\User::getItem();
        }

        if ($result->isValid()) {
            $arrayData = $result->getData();
        }

        return \Utils::patchJson(new Wrapper('users', $arrayData));
    }

}
