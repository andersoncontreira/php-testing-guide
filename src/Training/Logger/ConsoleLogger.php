<?php


namespace Training\Logger;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Training\Logger\Formatter\ConsoleFormatter;

class ConsoleLogger extends \Psr\Log\AbstractLogger
{
    /**
     * @var \Training\Logger\ConsoleLogger
     */
    private static $instance;

    /**
     * @var int
     */
    protected $logLevel = Logger::DEBUG;

    /**
     * @var \Monolog\Logger
     */
    protected $monolog;

    /**
     * @var string
     */
    protected $logName = "console";

    /**
     * @var string
     */
    protected $logFullPath = "./logs";


    /**
     * ConsoleLogger constructor.
     */
    private function __construct()
    {

        /**
         * Inicializa o log
         */
        $this->initialize();

    }
    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = [])
    {
        $this->monolog->log($level, $message, $context);
    }

    /**
     * Method initialize
     *
     * Initialize the configs for logger
     *
     *
     *
     */
    private function initialize()
    {
        $this->monolog = new Logger($this->logName);

        /**
         * Execuções por console sempre devem ser exibidas
         */
        $showOnly = $this->logLevel;


        $stream = new StreamHandler('php://stdout', $showOnly);
        $stream->setFormatter(new ConsoleFormatter());

        $this->monolog->pushHandler($stream);

        /**
         * File (Opcional)
         */
        // $stream = new StreamHandler($this->logFullPath, $showOnly);
        // $stream->setFormatter(new ConsoleFormatter());
        // $this->monolog->pushHandler($stream);
    }

    /**
     * Method getInstance
     * Singleton
     * @return \Training\Logger\ConsoleLogger
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}