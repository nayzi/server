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
 * Contient les méthodes de gestion d'une session
 * @class Session
 * @static
 * @namespace Logics
 */
class Session {

    /**
     * Stock les informations relative à l'utilisateur actuellement connecté
     * @property user
     * @protected
     * @type {Logics.User}
     * @default null
     */
    protected static $user = NULL;

    /**
     * Méthode applelé lorsque l'utilisateur se connecte
     * @method connect
     * @param {String} login Nom d'utilisateur (même que celui de la session Windows)
     * @param {String} pwd Mot de passe de l'utilisateur
     * @return {Logics.Response}
     */
    public static function connect($login, $pwd) {
        // Initialise l'objet de retour
        $result = new Response();

        $validWindowsUser = ADInterface::getUser($login, $pwd);

        //Vérifie que l'utilisateur existe dans la liste des sessions Windows
        if ($validWindowsUser->isValid()) {
            // Récupère l'ID de l'utilisateur
            $userId = \DB\DBInterface::get()->one('select Users_authenticate(:login, :realName) as "id";', array(
                ':login' => $login,
                ':realName' => $validWindowsUser->getData()
                    )
            );

            if ($userId['id'] > 0) {
                // Récupère la clé d'identification de l'utilisateur
                $userInfo = \DB\DBInterface::get()->one('call Users_getToken(:id);', array(':id' => $userId['id']), '\Logics\UserInfo');

                // Connexion réussi
                $result->setResult(TRUE);
                // Ajout des informations sur l'utilisateur à l'objet de retour
                $result->setData($userInfo);
            } else {
                $result->addError(200);
            }
        } else {
            // Récupère les erreurs précédement généré et les ajoutes à l'objet de retour
            $errors = $validWindowsUser->getErrors();
            $result->addError($errors[0]->getNumber());
        }

        return $result;
    }

    /**
     * Déconnecte l'utilisateur
     * @method disconnect
     * @return {Logics.Response}
     */
    public static function disconnect() {
        $result = new Response();

        if (self::isConnected()) {
            $nbRows = \DB\DBInterface::get()->execute('SELECT Users_updateToken(:uId);', array(
                ':uId' => self::getUser()->getId()
            ));
        } else {
            $nbRows = 0;
        }

        self::$user = NULL;

        if ($nbRows > 0) {
            $result->setResult(TRUE);
        } else {
            $result->addError(101);
        }

        return $result;
    }

    /**
     * Retrouve l'utilisateur connecté en utilisant l'ID et la clé envoyé dans
     * l'en-tête de la requête HTTP
     * @method restore
     * @param {Integer} userId ID de l'utilisateur à retrouver
     * @param {String} token Clé d'identification de l'utilisateur à retrouver
     */
    public static function restore($userId, $token) {
        // Récupère l'ID de l'utilisateur
        $logged = \DB\DBInterface::get()->one('select Users_checkSession(:id, :token) as "logged";', array(
            ':id' => $userId,
            ':token' => $token
                )
        );

        if ($logged['logged'] == TRUE) {
            self::setUser($userId);
        } else {
            http_response_code(401);
            \PASCException::raise(new \PASCException('User should be logged'));
        }
    }

    /**
     * Vérifie que l'utilisateur connecté a les accès nécessaire
     * @method hasAccess
     * @param {Integer[]} rights Droits nécessaires
     * @return {Boolean} Résultat de la vérification
     */
    public static function hasAccess($rights = null) {
        if (self::isConnected()) {
            if (is_null($rights) || count(array_intersect_key($rights, self::$user->getRights())) > 0) {
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * Retourne l'utilisateur connecté
     * @method getUser
     * @return {Logics.User}
     */
    public static function getUser() {
        if (self::isConnected()) {
            return self::$user;
        } else {
            \PASCException::raise(new \PASCException('User is not connected'));
        }
    }

    protected static function setUser($id) {
        $user = User::getItem($id);

        if ($user->isValid()) {
            self::$user = $user->getData();
        } else {
            \PASCException::raise(new \PASCException('Fail to fetch user with id ' . $id));
        }
    }

    /**
     * Indique si l'utilisateur est connecté
     * @method isConnected
     * @protected
     * @return {Boolean}
     */
    protected static function isConnected() {
        return !is_null(self::$user);
    }

}
