<?php

namespace App\OwnFolder\Sockets;

use App\OwnFolder\Sockets\Base\BaseSocket;
use Ratchet\ConnectionInterface;
use Illuminate\Support\Facades\Auth;
use App\Chat;


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
        $this->clients->detach($conn);
    }

    function onMessage(ConnectionInterface $from, $msg){
        $num = count($this->clients)-1;
            sprintf('Connection sending message'."\n",$from->resourceId,$msg,$num,$num == 1 ? '':'s');

        $getmessage = json_decode($msg);
           Chat::create([
               'from_id'=>$getmessage->user_id,
               'to_id'=>$getmessage->to_id,
               'content'=>$getmessage->content,
               'status'=>0

           ]);
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