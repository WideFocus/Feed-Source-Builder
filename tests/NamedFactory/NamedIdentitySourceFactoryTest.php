<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\NamedFactory;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\NamedFactory\NamedIdentitySourceFactory;
use WideFocus\Feed\Source\IdentitySourceFactoryInterface;
use WideFocus\Feed\Source\IdentitySourceInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\NamedFactory\NamedIdentitySourceFactory
 */
class NamedIdentitySourceFactoryTest extends PHPUnit_Framework_TestCase
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

        $namedFactory = new NamedIdentitySourceFactory();
        $namedFactory->addSourceFactory($factory, 'foo');
        return $namedFactory->createSource('foo', $parameters);
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\NamedFactory\InvalidIdentitySourceException
     *
     * @covers ::createSource
     */
    public function testCreateSourceException()
    {
        $parameters = $this->createMock(SourceParametersInterface::class);

        $namedFactory = new NamedIdentitySourceFactory();
        $namedFactory->createSource('not_existing', $parameters);
    }
}
