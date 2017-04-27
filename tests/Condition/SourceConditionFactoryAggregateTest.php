<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Condition;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Entity\FeedConditionInterface;
use WideFocus\Feed\Source\Builder\Condition\SourceConditionFactoryAggregate;
use WideFocus\Feed\Source\Builder\Condition\SourceConditionFactoryInterface;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Condition\SourceConditionFactoryAggregate
 */
class SourceConditionFactoryAggregateTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::addFactory
     * @covers ::create
     */
    public function testCreate()
    {
        $feedCondition = $this->createMock(FeedConditionInterface::class);
        $feedCondition
            ->expects($this->once())
            ->method('getType')
            ->willReturn('foo');

        $sourceParameters = $this->createMock(ParameterBagInterface::class);

        $condition = $this->createMock(SourceConditionInterface::class);
        $factory   = $this->createMock(SourceConditionFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('create')
            ->with($feedCondition, $sourceParameters)
            ->willReturn($condition);

        $factoryAggregate = new SourceConditionFactoryAggregate();
        $factoryAggregate->addFactory('foo', $factory);
        $this->assertEquals(
            $condition,
            $factoryAggregate->create($feedCondition, $sourceParameters)
        );
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\Condition\InvalidSourceConditionException
     *
     * @covers ::create
     */
    public function testCreateConditionException()
    {
        $feedCondition = $this->createMock(FeedConditionInterface::class);
        $feedCondition
            ->expects($this->once())
            ->method('getType')
            ->willReturn('not_existing');

        $sourceParameters = $this->createMock(ParameterBagInterface::class);

        $factoryAggregate = new SourceConditionFactoryAggregate();
        $factoryAggregate->create($feedCondition, $sourceParameters);
    }
}
