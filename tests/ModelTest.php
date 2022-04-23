<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use LiaTec\Manager\Testing\TestModel;
use LiaTec\Manager\Testing\TestSubModel;
use LiaTec\Manager\Testing\TestModelCollectionItem;

class ModelTest extends TestCase
{
    /**
     * @var TestModel
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass;

    /**
     * @var array
     */
    protected $bindings;

    /**
     * @var array
     */
    protected $payload;

    /**
     * @var array
     */
    protected $mutablePayload;

    public function setUp(): void
    {
        parent::setUp();

        $this->modelClass = TestModel::class;

        $this->bindings = [
            'isString'          => 'string',
            'isFloat'           => 'float',
            'isInt'             => 'integer',
            'isBoolean'         => 'boolean',
            'isModel'           => TestSubModel::class,
            'isModelCollection' => [TestModelCollectionItem::class],
        ];

        $this->payload = [
            'isString'          => '0823jdasdas',
            'isFloat'           => 54.254,
            'isInt'             => 54,
            'isBoolean'         => true,
            'isModel'           => [
                'name' => 'submodelstring',
            ],
            'isModelCollection' => [
                ['name' => 'collection sub model'],
            ],
        ];

        $this->mutablePayload = [
            'isString'          => '0823jdasdas',
            'isFloat'           => 54.254,
            'isInt'             => 54,
            'isBoolean'         => true,
            'isModel'           => [
                'name' => 'submodelstring',
            ],
            'isModelCollection' => [
                'name' => 'collection sub model',
            ],
        ];

        $this->model = new TestModel($this->payload);
    }

    /** @test */
    public function it_has_attributes(): void
    {
        foreach ($this->payload as $key => $value) {
            $this->assertNotEmpty($this->model->{$key});
        }
    }

    /** @test */
    public function it_sets_attributes(): void
    {
        /** @phpstan-ignore-next-line */
        $this->model->newAttribute = true;

        $this->assertNotEmpty($this->model->newAttribute);

        /** @phpstan-ignore-next-line */
        $this->assertTrue($this->model->newAttribute);
    }

    /** @test */
    public function it_gets_custom_attributes(): void
    {
        /** @phpstan-ignore-next-line */
        $this->assertNotEmpty($this->model->custom);
        
        /** @phpstan-ignore-next-line */
        $this->assertEquals('custom', $this->model->custom);
    }

    /** @test */
    public function it_set_model_bindings(): void
    {
        $bindings = [
            'isString'          => 'string',
            'isFloat'           => 'float',
            'isInt'             => 'integer',
            'isBoolean'         => 'boolean',
            'isModel'           => TestSubModel::class,
            'isModelCollection' => [TestModelCollectionItem::class],
        ];

        $this->model->setBindings($bindings);

        $this->assertNotEmpty($this->model->getBindings());

        foreach ($this->model->getBindings() as $key => $type) {
            $this->assertEquals($bindings[$key], $type);
        }
    }

    /** @test
     * @throws \Exception
     */
    public function it_hydrates_from_array(): void
    {
        $model = TestModel::hydrateFromArray($this->payload, $this->bindings);
        $this->assertInstanceOf(TestModel::class, $model);
    }

    /** @test
     * @throws \Exception
     */
    public function it_hydrates_from_array_with_mutable_collection(): void
    {
        $model = TestModel::hydrateFromArray($this->mutablePayload, $this->bindings);
        $this->assertInstanceOf(TestModel::class, $model);
        $this->assertCount(1, $model->isModelCollection);
    }
}
