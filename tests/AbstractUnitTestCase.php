<?php


namespace Training\Tests;


use PHPUnit\Framework\TestCase;
use Training\Logger\ConsoleLogger;
use Training\Tests\Helpers\DatabaseHelper;

/**
 * Class AbstractUnitTestCase
 *
 * Teste unitário base para os demais
 *
 * @package Training\Tests
 */
class AbstractUnitTestCase extends TestCase
{
    /**
     * @var \Training\Logger\ConsoleLogger
     */
    protected $logger;

    /**
     * Method setUp
     *
     * Test Set Up
     *
     */
    public function setUp()
    {

        /**
         * Logger instance
         */
        $this->logger = ConsoleLogger::getInstance();
    }

    /**
     * Method getConnection
     *
     *
     * @return \PDO
     *
     */
    public function getConnection() {

        return DatabaseHelper::getConnection();
    }
}