<?php


namespace Training\Tests;


use Training\Logger\ConsoleLogger;
use Training\Tests\Helpers\DatabaseHelper;

/**
 * Class AbstractUnitTestCase
 *
 * Teste unitário base para os demais
 *
 * @package Training\Tests
 */
class AbstractUnitTestCase extends \PHPUnit_Framework_TestCase
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