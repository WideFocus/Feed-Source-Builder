<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\NamedFactory;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\NamedFactory\NamedSourceParametersFactory;
use WideFocus\Feed\Source\SourceParametersFactoryInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\NamedFactory\NamedSourceParametersFactory
 */
class NamedSourceParametersFactoryTest extends PHPUnit_Framework_TestCase
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

        $namedFactory = new NamedSourceParametersFactory();
        $namedFactory->addParametersFactory($factory, 'foo');
        $this->assertEquals(
            $parameters,
            $namedFactory->createParameters('foo', $data)
        );
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\NamedFactory\InvalidSourceParametersException
     *
     * @covers ::createParameters
     */
    public function testCreateParametersException()
    {
        $data = ['some_data'];

        $namedFactory = new NamedSourceParametersFactory();
        $namedFactory->createParameters('not_existing', $data);
    }
}
