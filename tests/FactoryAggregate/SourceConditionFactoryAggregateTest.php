<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\FactoryAggregate;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\FactoryAggregate\SourceConditionFactoryAggregate;
use WideFocus\Feed\Source\Condition\SourceConditionCombinationInterface;
use WideFocus\Feed\Source\Condition\SourceConditionFactoryInterface;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\FactoryAggregate\SourceConditionFactoryAggregate
 */
class SourceConditionFactoryAggregateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return SourceConditionFactoryAggregate
     *
     * @covers ::__construct
     */
    public function testConstructor(): SourceConditionFactoryAggregate
    {
        return new SourceConditionFactoryAggregate(
            $this->createMock(SourceConditionFactoryInterface::class)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param SourceConditionFactoryAggregate $factoryAggregate
     *
     * @return void
     *
     * @covers ::addConditionFactory
     * @covers ::createCondition
     */
    public function testCreateCondition(SourceConditionFactoryAggregate $factoryAggregate)
    {
        $parameters = $this->createMock(SourceParametersInterface::class);

        $condition = $this->createMock(SourceConditionInterface::class);
        $factory   = $this->createMock(SourceConditionFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('createCondition')
            ->with($parameters)
            ->willReturn($condition);

        $factoryAggregate->addConditionFactory($factory, 'foo');
        $this->assertEquals(
            $condition,
            $factoryAggregate->createCondition('foo', $parameters)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param SourceConditionFactoryAggregate $factoryAggregate
     *
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\FactoryAggregate\InvalidSourceConditionException
     *
     * @covers ::createCondition
     */
    public function testCreateConditionException(SourceConditionFactoryAggregate $factoryAggregate)
    {
        $parameters = $this->createMock(SourceParametersInterface::class);
        $factoryAggregate->createCondition('not_existing', $parameters);
    }

    /**
     * @return void
     *
     * @covers ::__construct
     * @covers ::createCombinationCondition
     */
    public function testCreateCombinationCondition()
    {
        $parameters = $this->createMock(SourceParametersInterface::class);

        $condition = $this->createMock(SourceConditionCombinationInterface::class);
        $factory   = $this->createMock(SourceConditionFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('createCondition')
            ->with($parameters)
            ->willReturn($condition);

        $factoryAggregate = new SourceConditionFactoryAggregate($factory);
        $this->assertEquals(
            $condition,
            $factoryAggregate->createCombinationCondition($parameters)
        );
    }
}
