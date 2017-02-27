<?php

namespace App\OwnFolder\Sockets\Base;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class BaseSocket implements MessageComponentInterface{

    function onOpen(ConnectionInterface $conn){

    }


    function onClose(ConnectionInterface $conn){

    }

    function onMessage(ConnectionInterface $from, $msg){

    }

    function onError(ConnectionInterface $conn, \Exception $e){

    }
}