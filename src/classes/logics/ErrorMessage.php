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
 * Contient les messages d'erreur standard
 * @class ErrorMessage
 * @static
 * @namespace Logics
 */
class ErrorMessage {

    /**
     * Contient la liste des messages d'erreur standard
     * @property errorMessage
     * @protected
     * @type {Logics.Error[]}
     * @static
     */
    protected static $errorMessage;

    /**
     * Indique si la liste a été initialisé
     * @property init
     * @protected
     * @type {Boolean}
     * @static
     */
    protected static $init = FALSE;

    /**
     * Retourne l'erreur associé au numéro passé en paramètre
     * @method get
     * @param {Integer} errNo Numéro d'erreur
     * @return {Logics.Error}
     */
    public static function get($errNo) {
        self::init();

        if (array_key_exists($errNo, self::$errorMessage)) {
            return self::$errorMessage[$errNo];
        } else {
            \PASCException::raise(new \PASCException('Error number (' . $errNo . ') does not exist.'));
        }
    }

    protected static function init() {
        if (self::$init) {
            return;
        }

        self::$init = TRUE;

        self::$errorMessage = array(
            // Erreurs d'accès
            0 => new Error(0, 'Accès', 'Accès interdit'),
            // Erreurs de connexion/déconnexion
            100 => new Error(100, 'Connexion', 'Utilisateur inconnu'),
            101 => new Error(101, 'Connexion', 'Déconnexion avec erreurs'),
            // Erreurs de recherche
            200 => new Error(200, 'Recherche', 'Enregistrement non trouvé dans la BDD'),
            // Erreurs d'insertion
            300 => new Error(300, 'Insertion', 'Erreur lors de l\'insertion de l\'élément'),
            // Erreurs de mise à jour
            400 => new Error(400, 'Mise à jour', 'Impossible de mettre à jour l\'élément'),
            // Erreurs de suppréssion
            500 => new Error(500, 'Suppression', 'Impossible de supprimer l\'élément')
        );
    }

    // Cache le constructeur afin qu'on ne puisse pas créer d'instance de cette classe
    private function __construct() {
        
    }

}
