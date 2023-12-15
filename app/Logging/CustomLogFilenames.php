<?php 

namespace App\Logging;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\FormattableHandlerInterface;
use Monolog\Formatter\LineFormatter;

class CustomLogFilenames
{
    /**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger  $logger
     * @return void
     */
    public function __invoke($logger)
    {

        foreach ($logger->getHandlers() as $handler) {
            if ($handler instanceof RotatingFileHandler) {
                 $userId = auth()->user()->id;
                $handler->setFilenameFormat("{filename}-$userId-{date}", 'Y-m-d');
            }

            if ($handler instanceof FormattableHandlerInterface) {
                $handler->setFormatter(  new LineFormatter("[%datetime%]:  %message% %context%\n", 'Y-m-d H:i:s', true));   
            }
        }
    }
}