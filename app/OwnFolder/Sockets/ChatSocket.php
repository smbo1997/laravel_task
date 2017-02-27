<?php

namespace App\OwnFolder\Sockets;

use App\OwnFolder\Sockets\Base\BaseSocket;
use Ratchet\ConnectionInterface;


class ChatSocket extends BaseSocket{

    protected $clients;
    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    function onOpen(ConnectionInterface $conn){
        $this->clients->attach($conn);

        echo "new Connection ({$conn->resourceId})\n";
    }


    function onClose(ConnectionInterface $conn){
        echo "Close Connection ({$conn->resourceId})\n";
    }

    function onMessage(ConnectionInterface $from, $msg){
        $num = count($this->clients)-1;
           echo sprintf('Connection sending message'."\n",$from->resourceId,$msg,$num,$num == 1 ? '':'s');
           echo $from->resourceId;
           echo $num;
            foreach ($this->clients as $client){
                if ($from !==$client){
                    $client->send($msg);
                }
            }
    }

    function onError(ConnectionInterface $conn, \Exception $e){

        echo "Has Error {$e->getMessage()}\n";
        $conn->close();
    }
}