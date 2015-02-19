<?php

define("MODE_DEBUG", TRUE);
define("IS_SECURE", TRUE);

// Import API method
require_once '../classes/API.php';

API::init('../classes/', array(
    'type' => 'mysql',
    'name' => 'pasc-db',
    'user' => 'root',
    'pwd' => 'cinetic',
    'host' => 'localhost'
));

require_once '../libs/epiphany/Epi.php';
Epi::setPath('base', '../libs/epiphany');
Epi::setSetting('exceptions', !MODE_DEBUG);
Epi::init('api');

require_once 'routes.php';

try {
    getRoute()->run();
} catch(Exception $e) {
    http_response_code(404);
}
