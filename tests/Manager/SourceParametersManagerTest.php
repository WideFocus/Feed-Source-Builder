<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Manager;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\Manager\SourceParametersManager;
use WideFocus\Feed\Source\SourceParametersFactoryInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Manager\SourceParametersManager
 */
class SourceParametersManagerTest extends PHPUnit_Framework_TestCase
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
        $factory = $this->createMock(SourceParametersFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('createParameters')
            ->with($data)
            ->willReturn($parameters);

        $manager = new SourceParametersManager();
        $manager->addParametersFactory($factory, 'foo');
        $this->assertEquals(
            $parameters,
            $manager->createParameters('foo', $data)
        );
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\Manager\InvalidSourceParametersException
     *
     * @covers ::createParameters
     */
    public function testCreateParametersException()
    {
        $data = ['some_data'];

        $manager = new SourceParametersManager();
        $manager->createParameters('not_existing', $data);
    }
}
