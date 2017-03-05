<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests;

use ArrayIterator;
use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Entity\Source\FeedSourceParametersInterface;
use WideFocus\Feed\Source\Builder\NamedFactory\NamedSourceParametersFactoryInterface;
use WideFocus\Feed\Source\Builder\SourceParametersBuilder;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\SourceParametersBuilder
 */
class SourceParametersBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return SourceParametersBuilder
     *
     * @covers ::__construct
     */
    public function testConstructor(): SourceParametersBuilder
    {
        return new SourceParametersBuilder(
            $this->createMock(NamedSourceParametersFactoryInterface::class)
        );
    }

    /**
     * @return void
     *
     * @covers ::buildParameters
     */
    public function testBuildParameters()
    {
        $parameters = ['foo' => 'foo_value', 'bar' => 'bar_value'];
        
        $feedSourceParameters = $this->createMock(FeedSourceParametersInterface::class);
        $feedSourceParameters
            ->expects($this->once())
            ->method('getIterator')
            ->willReturn(new ArrayIterator($parameters));

        $feed = $this->createMock(FeedInterface::class);
        $feed
            ->expects($this->once())
            ->method('getSourceParameters')
            ->willReturn($feedSourceParameters);

        $feed
            ->expects($this->once())
            ->method('getSourceType')
            ->willReturn('foo');

        $sourceParameters = $this->createMock(SourceParametersInterface::class);

        $parametersFactory = $this->createMock(NamedSourceParametersFactoryInterface::class);
        $parametersFactory
            ->expects($this->once())
            ->method('createParameters')
            ->with('foo', $parameters)
            ->willReturn($sourceParameters);

        $builder = new SourceParametersBuilder($parametersFactory);
        $this->assertEquals($sourceParameters, $builder->buildParameters($feed));
    }
}
