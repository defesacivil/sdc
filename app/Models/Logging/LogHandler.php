<?php

namespace App\Models\Logging;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class LogHandler extends AbstractProcessingHandler
{

    /**
     *
     * Reference:
     * https://github.com/markhilton/monolog-mysql/blob/master/src/Logger/Monolog/Handler/MysqlHandler.php
     */
    public function __construct($level = Logger::DEBUG, $bubble = true)
    {
        $this->table = 'logs';
        parent::__construct($level, $bubble);
    }

    protected function write(array $record): void
    {
        $data = array(
            'level'         => $record['level_name'],
            'message'       => $record['message'],
            'instance'      => gethostname(),
            'user_id'       => Auth::user()->id,
            'context'       => json_encode($record['context']),
            'channel'       => $record['channel'],
            'formatted'     => $record['formatted'],
            'remote_addr'   => $_SERVER['REMOTE_ADDR'],
            'user_agent'    => $_SERVER['HTTP_USER_AGENT'],
        );
        
        DB::connection()->table($this->table)->insert($data);
    }
}
