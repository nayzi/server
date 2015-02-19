<?php

namespace DB;

// Make sure we don't directly access the file
if (!defined("IS_SECURE") || !IS_SECURE)
    die('I don\'t like you');

/*
 * @license PASC Client - Fives
 * Available via the MIT or new BSD license.
 */

/**
 * @module DB
 */

/**
 * Contient les méthodes de gestion de la base de données
 * @class DBInterface
 * @static
 * @namespace DB
 */
class DBInterface {

    const MySql = 'mysql';

    /**
     * Indique si l'interface a été initialisé au moins une fois
     * @property init
     * @protected
     * @type boolean
     * @default false
     */
    protected static $init = FALSE;

    /**
     * Stock les instances de l'interface
     * @property instances
     * @protected
     * @type {Logics.DBInterface[]}
     * @default []
     */
    protected static $instances = array();

    /**
     * Type de base de donnée
     * @property type
     * @protected
     * @static
     * @type {String}
     */
    protected static $type = "";

    /**
     * Nom de la BDD
     * @property name
     * @protected
     * @static
     * @type {String}
     */
    protected static $name = "";

    /**
     * Adresse de la BDD
     * @property host
     * @protected
     * @static
     * @type {String}
     */
    protected static $host = "";

    /**
     * Nom d'utilisateur
     * @property user
     * @protected
     * @static
     * @type {String}
     */
    protected static $user = "";

    /**
     * Mot de passe
     * @property pwd
     * @protected
     * @static
     * @type {String}
     */
    protected static $pwd = "";

    /**
     * Type de base de donnée
     * @property _type
     * @protected
     * @type {String}
     */
    protected $_type = "";

    /**
     * Nom de la BDD
     * @property _name
     * @protected
     * @type {String}
     */
    protected $_name = "";

    /**
     * Adresse de la BDD
     * @property _host
     * @protected
     * @type {String}
     */
    protected $_host = "";

    /**
     * Nom d'utilisateur
     * @property _user
     * @protected
     * @type {String}
     */
    protected $_user = "";

    /**
     * Mot de passe
     * @property _pwd
     * @protected
     * @type {String}
     */
    protected $_pwd = "";

    /**
     * Connexion à la BDD
     * @property dbh
     * @protected
     * @type {PDO}
     */
    protected $dbh;

    /**
     * Retourne l'instance correspondant aux paramètres de connexion fournit en paramètre
     * @method getInstance
     * @static
     * @param {String} type Type de BDD
     * @param {String} name Nom de la base de donnée
     * @param {String} host Adresse de la BDD
     * @param {String} user Nom d'utilisateur
     * @param {String} pwd Mot de passe
     * @return {DB.DBInterface}
     */
    public static function getInstance($type, $name, $host = 'localhost', $user = 'root', $pwd = '') {
        $args = func_get_args();
        $hash = md5(implode('~', $args));
        if (isset(self::$instances[$hash]))
            return self::$instances[$hash];

        self::$instances[$hash] = new DBInterface();
        self::$instances[$hash]->_type = $type;
        self::$instances[$hash]->_name = $name;
        self::$instances[$hash]->_host = $host;
        self::$instances[$hash]->_user = $user;
        self::$instances[$hash]->_pwd = $pwd;

        return self::$instances[$hash];
    }

    /**
     * Exécute une requête SQL et retourne le nombre de lignes affecté
     * @method execute
     * @param {String} sql Requête SQL
     * @param {String[]} params Paramètres à remplacer dans la requête
     * @return {Integer} Nombre de lignes affecté
     */
    public function execute($sql = false, $params = array()) {
        $this->init();
        try {
            $sth = $this->prepare($sql, $params);
            if (preg_match('/insert/i', $sql)) {
                return $this->dbh->lastInsertId();
            } else if (preg_match('/_create/i', $sql)) {
                return $this->one('select LAST_INSERT_ID() as "id";');
            } else {
                return $sth->rowCount();
            }
        } catch (PDOException $e) {
            \PASCException::raise(new \PASCException("Query error: {$e->getMessage()} - {$sql}"));
            return false;
        }
    }

    /**
     * Retourne l'ID du dernier élément inséré dans la BDD
     * @method insertId
     * @return {Integer|Boolean} Retourne `FALSE` s'il ne trouve pas d'ID
     */
    public function insertId() {
        $this->init();
        $id = $this->dbh->lastInsertId();

        if ($id > 0) {
            return $id;
        }

        return false;
    }

    /**
     * Sélectionne plusieurs lignes dans la BDD
     * @method all
     * @param {String} sql Requête SQL
     * @param {String[]} params Paramètres à remplacer dans la requête
     * @param {String} toObject Nom de la classe à instancier pour chaque enregistrement
     * @return {String[]|Object[]}
     */
    public function all($sql = false, $params = array(), $toObject = false) {
        $this->init();
        try {
            $sth = $this->prepare($sql, $params);
            if ($toObject) {
                $sth->setFetchMode(\PDO::FETCH_CLASS, $toObject);
                return $sth->fetchAll(\PDO::FETCH_CLASS, $toObject);
            } else {
                return $sth->fetchAll(\PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            \PASCException::raise(new \PASCException("Query error: {$e->getMessage()} - {$sql}"));
            return false;
        }
    }

    /**
     * Sélectionne une seule ligne dans la BDD
     * @method one
     * @param {String} sql Requête SQL
     * @param {String[]} params Paramètres à remplacer dans la requête
     * @param {String} toObject Nom de la classe à instancier pour chaque enregistrement
     * @return {String[]|Object}
     */
    public function one($sql = false, $params = array(), $toObject = false) {
        $this->init();

        try {
            $sth = $this->prepare($sql, $params);
            if ($toObject) {
                $sth->setFetchMode(\PDO::FETCH_CLASS, $toObject);
                return $sth->fetch(\PDO::FETCH_CLASS);
            } else {
                return $sth->fetch(\PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            \PASCException::raise(new \PASCException("Query error: {$e->getMessage()} - {$sql}"));
            return false;
        }
    }

    /**
     * Retourne les paramètres de connexion
     * 
     * Permet de changer les paramètres de connexion en passant des paramètres
     * @method employ
     * @static
     * @param {String} type Type de BDD
     * @param {String} name Nom de la base de donnée
     * @param {String} host Adresse de la BDD
     * @param {String} user Nom d'utilisateur
     * @param {String} pwd Mot de passe
     * @return {String[]} Paramètre de connexion à la base de donnée
     */
    public static function employ($type = null, $name = null, $host = 'localhost', $user = 'root', $pwd = '') {
        if (!empty($type) && !empty($name)) {
            self::$type = $type;
            self::$name = $name;
            self::$host = $host;
            self::$user = $user;
            self::$pwd = $pwd;
        }

        return array('type' => self::$type, 'name' => self::$name, 'host' => self::$host, 'user' => self::$user, 'pass' => self::$pwd);
    }

    /**
     * Retourne la dernière instance utilisé
     * @method get
     * @static
     * @return {DB.DBInterface}
     */
    public static function get() {
        $db = DBInterface::employ();
        if (empty($db['type']) || empty($db['name']) || empty($db['host']) || empty($db['user'])) {
            \PASCException::raise(new \PASCException('Could not determine which database module to load', 404));
        } else {
            return DBInterface::getInstance($db['type'], $db['name'], $db['host'], $db['user'], $db['pass']);
        }
    }

    /**
     * Fait en sorte que la connexion soit établit
     * @method init
     * @protected
     */
    protected function init() {
        if ($this->dbh)
            return;

        try {
            $this->dbh = new \PDO($this->_type . ':host=' . $this->_host . ';dbname=' . $this->_name . ';charset=utf8', $this->_user, $this->_pwd);
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            \PASCException::raise(new \PASCException('Could not connect to database'));
        }
    }

    /**
     * Prépare et exécute une requête
     * @method prepare
     * @protected
     * @param {String} sql
     * @param {String[]} params
     * @return {Boolean}
     */
    protected function prepare($sql, $params = array()) {
        try {
            $sth = $this->dbh->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
            $sth->execute($params);
            return $sth;
        } catch (\PDOException $e) {
            \PASCException::raise(new \PASCException("Query error: {$e->getMessage()} - {$sql}"));
            return false;
        }
    }

    // Cache le constructeur afin qu'on ne puisse pas créer d'instance de cette classe
    private function __construct() {
        
    }

}
