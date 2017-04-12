<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\FactoryAggregate;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\FactoryAggregate\SourceFieldFactoryAggregate;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\Field\SourceFieldFactoryInterface;
use WideFocus\Feed\Source\Field\SourceFieldInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\FactoryAggregate\SourceFieldFactoryAggregate
 */
class SourceFieldFactoryAggregateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return SourceFieldFactoryAggregate
     *
     * @covers ::__construct
     */
    public function testConstructor(): SourceFieldFactoryAggregate
    {
        return new SourceFieldFactoryAggregate(
            $this->createMock(SourceFieldFactoryInterface::class)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param SourceFieldFactoryAggregate $factoryAggregate
     *
     * @return void
     *
     * @covers ::addFieldFactory
     * @covers ::createField
     */
    public function testCreateField(SourceFieldFactoryAggregate $factoryAggregate)
    {
        $parameters = $this->createMock(SourceParametersInterface::class);

        $field   = $this->createMock(SourceFieldInterface::class);
        $factory = $this->createMock(SourceFieldFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('createField')
            ->with($parameters)
            ->willReturn($field);

        $factoryAggregate->addFieldFactory($factory, 'foo');
        $this->assertEquals(
            $field,
            $factoryAggregate->createField('foo', $parameters)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param SourceFieldFactoryAggregate $factoryAggregate
     *
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\FactoryAggregate\InvalidSourceFieldException
     *
     * @covers ::createField
     */
    public function testCreateFieldException(SourceFieldFactoryAggregate $factoryAggregate)
    {
        $parameters = $this->createMock(SourceParametersInterface::class);
        $factoryAggregate->createField('not_existing', $parameters);
    }

    /**
     * @return void
     *
     * @covers ::__construct
     * @covers ::createCombinationField
     */
    public function testCreateCombinationField()
    {
        $parameters = $this->createMock(SourceParametersInterface::class);

        $field   = $this->createMock(SourceFieldCombinationInterface::class);
        $factory = $this->createMock(SourceFieldFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('createField')
            ->with($parameters)
            ->willReturn($field);

        $factoryAggregate = new SourceFieldFactoryAggregate($factory);
        $this->assertEquals(
            $field,
            $factoryAggregate->createCombinationField($parameters)
        );
    }
}
