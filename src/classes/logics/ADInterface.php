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
 * Contient les méthodes d'accès à l'Active directory
 * @class ADInterface
 * @static
 * @namespace Logics
 */
class ADInterface {

    /**
     * Description of the method getUser.
     * @method getUser
     * @static
     * @param {String} login Login de session Windows de l'utilisateur
     * @param {String} pwd Mot de passe
     * @return {Logics.Response}
     */
    public static function getUser($login, $pwd) {
        $result = new Response();

        $AD = array(
            'host' => 'ldap://192.168.1.2',
            'port' => 636,
            'domain' => 'cinetic-transitique.lan'
        );


        // Tentative de connexion à l'Active Directory
        $ADConn = \ldap_connect($AD['host'], $AD['port']) or die('Connection to AD failed.');

        // Tentative de connexion avec les identifiants fournits
        $user = @\ldap_bind($ADConn, $login . '@' . $AD['domain'], $pwd);

        // L'utilisateur existe
        if ($user) {
            $filter = "(&(objectClass=user)(samaccountname=".$login.")(cn=*))";
            $sr = \ldap_search($ADConn, "OU=Utilisateurs,OU=CINETIC,DC=cinetic-transitique,DC=lan", $filter);
            $info = \ldap_get_entries($ADConn, $sr);

            $username = $info[0]["displayname"][0];

            
            $result->setResult(TRUE);
            $result->setData($username);
        } else {
            $result->addError(100);
        }

        return $result;
    }

    // Cache le constructeur afin qu'on ne puisse pas créer d'instance de cette classe
    private function __construct() {
        
    }

}
