<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Field;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Entity\FeedFieldInterface;
use WideFocus\Feed\Source\Builder\Field\SourceFieldFactoryAggregate;
use WideFocus\Feed\Source\Builder\Field\SourceFieldFactoryInterface;
use WideFocus\Feed\Source\Field\SourceFieldInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Field\SourceFieldFactoryAggregate
 */
class SourceFieldFactoryAggregateTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::addFactory
     * @covers ::create
     */
    public function testCreate()
    {
        $feedField = $this->createMock(FeedFieldInterface::class);
        $feedField
            ->expects($this->once())
            ->method('getType')
            ->willReturn('foo');

        $sourceParameters = $this->createMock(ParameterBagInterface::class);

        $field   = $this->createMock(SourceFieldInterface::class);
        $factory = $this->createMock(SourceFieldFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('create')
            ->with($feedField, $sourceParameters)
            ->willReturn($field);

        $factoryAggregate = new SourceFieldFactoryAggregate();
        $factoryAggregate->addFactory('foo', $factory);
        $this->assertEquals(
            $field,
            $factoryAggregate->create($feedField, $sourceParameters)
        );
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\Field\InvalidSourceFieldException
     *
     * @covers ::create
     */
    public function testCreateFieldException()
    {
        $feedField = $this->createMock(FeedFieldInterface::class);
        $feedField
            ->expects($this->once())
            ->method('getType')
            ->willReturn('not_existing');

        $sourceParameters = $this->createMock(ParameterBagInterface::class);

        $factoryAggregate = new SourceFieldFactoryAggregate();
        $factoryAggregate->create($feedField, $sourceParameters);
    }
}
