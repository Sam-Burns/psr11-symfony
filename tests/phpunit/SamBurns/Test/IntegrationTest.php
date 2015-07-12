<?php
namespace SamBurns\Test;

use PHPUnit_Framework_TestCase as TestCase;
use SamBurns\Psr11Symfony\ServiceContainer;

class IntegrationTest extends TestCase
{
    public function testDiContainer()
    {
        // ARRANGE
        $container = new ServiceContainer();
        $container->addConfigFilesFromFolder(__DIR__ . '/../../../fixtures/');

        // ACT
        $result = $container->get('stdclass');

        // ASSERT
        $this->assertInstanceOf('\stdClass', $result);
    }
}
