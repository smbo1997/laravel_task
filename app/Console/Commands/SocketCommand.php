<?php

namespace App\Console\Commands;

use App\OwnFolder\Sockets\ChatSocket;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class SocketCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chatserver:go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Own Server';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start Server');
        $server = IoServer::factory(
            new HttpServer(
                    new WsServer(
                        new ChatSocket()
                    )
            ),8080
        );

        $server->run();

    }
}
