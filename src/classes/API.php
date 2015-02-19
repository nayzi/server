<?php

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
 * Regroupe les méthodes de gestion de l'API.
 * 
 * @class API
 * @static
 * @namespace API
 */
class API {

    /**
     * Liste des dépendances
     * @property manifest
     * @static
     * @protected
     * @type {String[]}
     */
    protected static $manifest = array(
        'base' => array('Patch', 'PASCException', 'Utils'),
        'api' => array('subItems', 'Wrapper', 'Climat', 'Conveyor', 'ConveyorOption',
            'ConveyorType', 'ConveyorTypeOption', 'Deal', 'Action', 'Log', 'Option', 'OrderPiece',
            'OptionType', 'Order', 'OrderOption', 'Piece', 'PieceAvailability', 'PieceOrder',
            'PieceOrderOption', 'PieceType', 'Right', 'User', 'Utils', 'OrderPieceOption'),
        'logics' => array('itemOption', 'response', 'ADInterface', 'Climat',
            'Conveyor', 'ConveyorOption', 'ConveyorType', 'ConveyorTypeOption', 'OrderPiece',
            'Deal', 'Action', 'Log', 'Option', 'OptionType', 'Order', 'OrderOption',
            'OrderStatus', 'Piece', 'PieceAvailability', 'PieceOrder', 'PieceOrderOption',
            'PieceType', 'Right', 'Session', 'User', 'UserInfo', 'Utils', 'OrderPieceOption'),
        'item' => array('Item'),
        'itemOption' => array('item', 'ItemOption'),
        'subItems' => array('item', 'ItemDeletable', 'ItemCreatable', 'ItemUpdatable'),
        'response' => array('Error', 'ErrorMessage', 'Response')
    );

    /**
     * Liste des fichiers déjà inclus
     * @property included
     * @static
     * @protected
     * @type {Boolean[]}
     */
    protected static $included = array();

    /**
     * Initialise l'API.
     * @method init
     * @static
     * @param {String} pathToClasses Chemin d'accès aux classes depuis le fichier qui est exécuté
     * @param {String[]} dbConfig Liste des paramètres de connexion à la base de donnée voir {{#crossLink "DB.DBInterface"}}{{/crossLink}}
     */
    public static function init($pathToClasses, $dbConfig) {
        // Charge les dépendences
        self::loadDependencies($pathToClasses);

        \DB\DBInterface::employ($dbConfig['type'], $dbConfig['name'], $dbConfig['host'], $dbConfig['user'], $dbConfig['pwd']);

        $header = apache_request_headers();
        if (array_key_exists('Authorization', $header) && isset($header['Authorization'])) {
            $info = json_decode($header['Authorization'], true);

            if (isset($info['token']) && isset($info['id'])) {
                \Logics\Session::restore($info['id'], $info['token']);
            } else {
                PASCException::raise(new PASCException('Failed to continue session'));
            }
        }
    }

    /**
     * Charge les dépendences
     * @method loadDependencies
     * @protected
     * @static
     * @param {String} pathToClasses Chemin d'accès aux classes depuis le fichier qui est exécuté
     */
    protected static function loadDependencies($pathToClasses) {
        // Import de la classe de gestion de la base de donnée
        require_once($pathToClasses . 'db/DBInterface.php');

        self::loadClasses('base', $pathToClasses);
        self::loadClasses('logics', $pathToClasses . 'logics/');
        self::loadClasses('api', $pathToClasses . 'api/');
    }

    /**
     * Charge les classes PHP
     * @method loadClasses
     * @protected
     * @static
     * @param {String} dep Nom de la dépendence
     * @param {String} pathToClasses Chemin d'accès aux classes depuis le fichier qui est exécuté
     */
    protected static function loadClasses($dep, $pathToClasses) {
        $value = isset(self::$manifest[$dep]) ? self::$manifest[$dep] : $dep;

        if (!is_array($value)) {
            if (!isset(self::$included[$pathToClasses . $value]) && file_exists($pathToClasses . $value . '.php')) {
                require_once $pathToClasses . $value . '.php';
            }
            self::$included[$pathToClasses . $value] = 1;
        } else {
            foreach ($value as $d) {
                self::loadClasses($d, $pathToClasses);
            }
        }
    }

    // Cache le constructeur afin qu'on ne puisse pas créer d'instance de cette classe
    private function __construct() {
        
    }

}
