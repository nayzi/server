<?php

// Make sure we don't directly access the file
if (!defined("IS_SECURE") || !IS_SECURE)
    die('I don\'t like you');

/**
 * @module Utils
 */

/**
 * @class PASCException
 * @extends Exception
 * @namespace Utils
 */
class PASCException extends Exception {

    /**
     * Ajoute une exception à la liste
     * @method raise
     * @static
     * @param {Utils.PASCException|Exception} exception Une exception
     */
    public static function raise($exception) {
        if (!defined('MODE_DEBUG') || !MODE_DEBUG) {
            throw new $exception($exception->getMessage(), $exception->getCode());
        } else {
            echo sprintf("Une erreur est survenu et les <strong>exceptions</strong> sont désactivées, nous affichons donc les informations.
                    Pour activer les exceptions vous devez change la valeur : <em>MODE_DEBUG</em> dans <strong>api/index.php</strong>.
                    <ul><li>Fichier: %s</li><li>Ligne: %s</li><li>Message: %s</li><li>Stack trace: %s</li></ul>", $exception->getFile(), $exception->getLine(), $exception->getMessage(), nl2br($exception->getTraceAsString()));
        }
    }

}
