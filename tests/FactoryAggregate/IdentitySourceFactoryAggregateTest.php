<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\FactoryAggregate;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\FactoryAggregate\IdentitySourceFactoryAggregate;
use WideFocus\Feed\Source\IdentitySourceFactoryInterface;
use WideFocus\Feed\Source\IdentitySourceInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\FactoryAggregate\IdentitySourceFactoryAggregate
 */
class IdentitySourceFactoryAggregateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return IdentitySourceInterface
     *
     * @covers ::createSource
     * @covers ::addSourceFactory
     */
    public function testCreateSource(): IdentitySourceInterface
    {
        $source     = $this->createMock(IdentitySourceInterface::class);
        $parameters = $this->createMock(SourceParametersInterface::class);

        $factory = $this->createMock(IdentitySourceFactoryInterface::class);
        $factory->expects($this->once())
            ->method('createSource')
            ->with($parameters)
            ->willReturn($source);

        $factoryAggregate = new IdentitySourceFactoryAggregate();
        $factoryAggregate->addSourceFactory($factory, 'foo');
        return $factoryAggregate->createSource('foo', $parameters);
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\FactoryAggregate\InvalidIdentitySourceException
     *
     * @covers ::createSource
     */
    public function testCreateSourceException()
    {
        $parameters = $this->createMock(SourceParametersInterface::class);

        $factoryAggregate = new IdentitySourceFactoryAggregate();
        $factoryAggregate->createSource('not_existing', $parameters);
    }
}
