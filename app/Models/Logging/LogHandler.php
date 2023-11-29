<?php

namespace App\Logging;

use App\Events\LogJobEvent;
use Illuminate\Log\Logger;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\AbstractProcessingHandler;

use MonologLogger;

class LogJobHandler extends AbstractProcessingHandler
{
    public function __construct($level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    /**
     * @inheritDoc
     */
    protected function write(array $record): void
    {
        $log = new LogJob();
        $log->fill($record['formatted']);
        $log->save();
    }

    protected function getDefaultFormatter(): FormatterInterface
    {
        return new LogFormatter();
    }
}