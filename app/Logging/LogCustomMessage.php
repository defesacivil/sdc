<?php

namespace App\Logging;

use Monolog\Logger;

class LogCustomMessage
{

    /**
     * Create a custom Monolog instance.
     *
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config): Logger
    {
        $logger = new Logger("LogHandler");

        $hand = new \App\Models\Logging\LogHandler();
        
        return $logger->pushHandler(new \App\Models\Logging\LogHandler());
    }
}