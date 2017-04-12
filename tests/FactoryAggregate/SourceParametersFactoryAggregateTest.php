<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\FactoryAggregate;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\FactoryAggregate\SourceParametersFactoryAggregate;
use WideFocus\Feed\Source\SourceParametersFactoryInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\FactoryAggregate\SourceParametersFactoryAggregate
 */
class SourceParametersFactoryAggregateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @covers ::addParametersFactory
     * @covers ::createParameters
     */
    public function testCreateParameters()
    {
        $data = ['some_data'];

        $parameters = $this->createMock(SourceParametersInterface::class);
        $factory    = $this->createMock(SourceParametersFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('createParameters')
            ->with($data)
            ->willReturn($parameters);

        $factoryAggregate = new SourceParametersFactoryAggregate();
        $factoryAggregate->addParametersFactory($factory, 'foo');
        $this->assertEquals(
            $parameters,
            $factoryAggregate->createParameters('foo', $data)
        );
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\FactoryAggregate\InvalidSourceParametersException
     *
     * @covers ::createParameters
     */
    public function testCreateParametersException()
    {
        $data = ['some_data'];

        $factoryAggregate = new SourceParametersFactoryAggregate();
        $factoryAggregate->createParameters('not_existing', $data);
    }
}
