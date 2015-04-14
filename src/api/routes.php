<?php

// Make sure we don't directly access the file
if (!defined("IS_SECURE") || !IS_SECURE)
    die('I don\'t like you');

getApi()->get('/recordExists', array('\API\Utils', 'recordExists'), EpiApi::external);
// Utilisateur
getApi()->get('/users/(\d+)', array('\API\User', 'getItem'), EpiApi::external);
getApi()->post('/session', array('\API\User', 'connect'), EpiApi::external);
getApi()->delete('/session', array('\API\User', 'disconnect'), EpiApi::external);
// Type de convoyeurs
getApi()->get('/conveyorTypes', array('\API\ConveyorType', 'getItems'), EpiApi::external);
getApi()->get('/conveyorTypes/(\d+)', array('\API\ConveyorType', 'getItem'), EpiApi::external);
// Droits d'accès
getApi()->get('/rights', array('\API\Right', 'getItems'), EpiApi::external);
getApi()->get('/rights/(\d+)', array('\API\Right', 'getItem'), EpiApi::external);
// Actions
getApi()->get('/actions/(\d+)', array('\API\Action', 'getItem'), EpiApi::external);
getApi()->get('/actions', array('\API\Action', 'getItems'), EpiApi::external);
// Affaires
getApi()->get('/deals', array('\API\Deal', 'getItems'), EpiApi::external);
getApi()->get('/deals/(\d+)', array('\API\Deal', 'getItem'), EpiApi::external);
getApi()->post('/deals', array('\API\Deal', 'create'), EpiApi::external);
getApi()->put('/deals/(\d+)', array('\API\Deal', 'update'), EpiApi::external);
getApi()->delete('/deals/(\d+)', array('\API\Deal', 'delete'), EpiApi::external);
// Climats
getApi()->get('/climats', array('\API\Climat', 'getItems'), EpiApi::external);
getApi()->get('/climats/(\d+)', array('\API\Climat', 'getItem'), EpiApi::external);
// Options de type de convoyeurs
getApi()->get('/conveyorTypeOptions', array('\API\ConveyorTypeOption', 'getItems'), EpiApi::external);
getApi()->get('/conveyorTypeOptions/(\d+)', array('\API\ConveyorTypeOption', 'getItem'), EpiApi::external);
// Options
getApi()->get('/options', array('\API\Option', 'getItems'), EpiApi::external);
getApi()->get('/options/(\d+)', array('\API\Option', 'getItem'), EpiApi::external);
// Types d'options
getApi()->get('/optionTypes', array('\API\OptionType', 'getItems'), EpiApi::external);
getApi()->get('/optionTypes/(\d+)', array('\API\OptionType', 'getItem'), EpiApi::external);
// Types de pièces
getApi()->get('/pieceTypes', array('\API\PieceType', 'getItems'), EpiApi::external);
getApi()->get('/pieceTypes/(\d+)', array('\API\PieceType', 'getItem'), EpiApi::external);
// Pièces
getApi()->get('/pieces', array('\API\Piece', 'getItems'), EpiApi::external);
getApi()->get('/pieces/(\d+)', array('\API\Piece', 'getItem'), EpiApi::external);
// Disponibilités de pièce
getApi()->get('/pieceAvailabilities', array('\API\PieceAvailability', 'getItems'), EpiApi::external);
getApi()->get('/pieceAvailabilities/(\d+)', array('\API\PieceAvailability', 'getItem'), EpiApi::external);
// Bon de commande
getApi()->post('/orders', array('\API\Order', 'create'), EpiApi::external);
getApi()->get('/orders', array('\API\Order', 'getItems'), EpiApi::external);
getApi()->get('/orders/(\d+)', array('\API\Order', 'getItem'), EpiApi::external);
getApi()->delete('/orders/(\d+)', array('\API\Order', 'delete'), EpiApi::external);
// Pièces pour un bon de commande
getApi()->post('/orderPieces', array('\API\OrderPiece', 'create'), EpiApi::external);
getApi()->get('/orderPieces', array('\API\OrderPiece', 'getItems'), EpiApi::external);
getApi()->get('/orderPieces/(\d+)', array('\API\OrderPiece', 'getItem'), EpiApi::external);
// Pièces pour un convoyeur
getApi()->post('/pieceOrders', array('\API\PieceOrder', 'create'), EpiApi::external);
getApi()->get('/pieceOrders', array('\API\PieceOrder', 'getItems'), EpiApi::external);
getApi()->get('/pieceOrders/(\d+)', array('\API\PieceOrder', 'getItem'), EpiApi::external);
// Options des pièces d'un bon de commande
getApi()->post('/orderPieceOptions', array('\API\OrderPieceOption', 'create'), EpiApi::external);
getApi()->get('/orderPieceOptions', array('\API\OrderPieceOption', 'getItems'), EpiApi::external);
getApi()->get('/orderPieceOptions/(\d+)', array('\API\OrderPieceOption', 'getItem'), EpiApi::external);
// Options d'un bon de commande
getApi()->post('/orderOptions', array('\API\OrderOption', 'create'), EpiApi::external);
getApi()->get('/orderOptions', array('\API\OrderOption', 'getItems'), EpiApi::external);
getApi()->get('/orderOptions/(\d+)', array('\API\OrderOption', 'getItem'), EpiApi::external);

// Options d'un convoyeur
getApi()->post('/conveyorOptions', array('\API\ConveyorOption', 'create'), EpiApi::external);
getApi()->get('/conveyorOptions', array('\API\ConveyorOption', 'getItems'), EpiApi::external);
getApi()->get('/conveyorOptions/(\d+)', array('\API\ConveyorOption', 'getItem'), EpiApi::external);
// Convoyeur
getApi()->post('/conveyors', array('\API\Conveyor', 'create'), EpiApi::external);
getApi()->get('/conveyors', array('\API\Conveyor', 'getItems'), EpiApi::external);
getApi()->get('/conveyors/(\d+)', array('\API\Conveyor', 'getItem'), EpiApi::external);