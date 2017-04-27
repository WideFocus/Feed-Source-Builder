<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Validator;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Builder\Validator\ValidatorFactoryAggregate;
use WideFocus\Feed\Source\Builder\Validator\ValidatorFactoryInterface;
use WideFocus\Parameters\ParameterBagInterface;
use WideFocus\Validator\ValidatorInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Validator\ValidatorFactoryAggregate
 */
class ValidatorFactoryAggregateTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::addFactory
     * @covers ::create
     */
    public function testCreate()
    {
        $constraints = $this->createMock(ParameterBagInterface::class);

        $validator = $this->createMock(ValidatorInterface::class);
        $factory   = $this->createMock(ValidatorFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('create')
            ->with($constraints)
            ->willReturn($validator);

        $factoryAggregate = new ValidatorFactoryAggregate();
        $factoryAggregate->addFactory('foo', $factory);
        $this->assertEquals(
            $validator,
            $factoryAggregate->create('foo', $constraints)
        );
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\Validator\InvalidValidatorException
     *
     * @covers ::create
     */
    public function testCreateConditionException()
    {
        $constraints = $this->createMock(ParameterBagInterface::class);

        $factoryAggregate = new ValidatorFactoryAggregate();
        $factoryAggregate->create('invalid', $constraints);
    }
}
