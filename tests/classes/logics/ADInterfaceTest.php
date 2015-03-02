<?php

define('IS_SECURE', true);
require 'src/classes/Patch.php';
require 'src/classes/PASCException.php';
require 'src/classes/logics/ErrorMessage.php';
require 'src/classes/logics/Error.php';
require 'src/classes/logics/Response.php';
require 'src/classes/logics/ADInterface.php';

class ADInterfaceTest extends PHPUnit_Framework_TestCase {

    public function testGetUser() {
        $this->assertEquals(2, \api\OrderPieceOption::getItem(1)->id());
    }

}
