<?php

namespace Tests;

use LiaTec\Manager\Testing\TestFactory;
use LiaTec\Manager\Testing\TestManager;
use PHPUnit\Framework\TestCase;

class ManagerTest extends TestCase
{
    protected $factory;

    public function setUp(): void
    {
        parent::setUp();
        $this->factory = TestFactory::instance();
    }

    /** @test */
    public function it_sets_manager_to_factory()
    {
        $this->factory->setManager('test', TestManager::class);
        $managers    = $this->factory->getManagers();
        $testManager = $this->factory->getManager('test');
        $this->assertEquals(TestManager::class, $testManager);
        $this->assertArrayHasKey('test', $managers);
    }

    /** @test */
    public function it_passes_parameters_to_manager()
    {
        $this->factory->setManager('test', TestManager::class);

        $manager = $this->factory->test('foo', 'bar');

        $this->assertEquals($manager->foo, 'foo');
        $this->assertEquals($manager->bar, 'bar');
    }
}
