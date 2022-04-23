<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use LiaTec\Manager\Testing\TestManager;
use LiaTec\Manager\Testing\TestFactory;

class FactoryTest extends TestCase
{
    /**
     * @var TestFactory
     */
    protected $factory;

    public function setUp(): void
    {
        parent::setUp();
        $this->factory = new TestFactory();
    }

    /** @test
     * @throws \Exception
     */
    public function it_sets_manager_to_factory(): void
    {
        $this->factory->setManager('test', TestManager::class);
        $managers    = $this->factory->getManagers();
        $testManager = $this->factory->getManager('test');
        $this->assertEquals(TestManager::class, $testManager);
        $this->assertArrayHasKey('test', $managers);
    }

    /** @test */
    public function it_passes_parameters_to_manager(): void
    {
        $this->factory->setManager('test', TestManager::class);

        /** @phpstan-ignore-next-line */
        $manager = $this->factory->test('foo', 'bar');

        $this->assertEquals('foo', $manager->foo);
        $this->assertEquals('bar', $manager->bar);
    }
}
