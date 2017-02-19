<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Manager;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\Manager\IdentitySourceManager;
use WideFocus\Feed\Source\IdentitySourceFactoryInterface;
use WideFocus\Feed\Source\IdentitySourceInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Manager\IdentitySourceManager
 */
class IdentitySourceManagerTest extends PHPUnit_Framework_TestCase
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

        $manager = new IdentitySourceManager();
        $manager->addSourceFactory($factory, 'foo');
        return $manager->createSource('foo', $parameters);
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\Manager\InvalidIdentitySourceException
     *
     * @covers ::createSource
     */
    public function testCreateSourceException()
    {
        $parameters = $this->createMock(SourceParametersInterface::class);

        $manager = new IdentitySourceManager();
        $manager->createSource('not_existing', $parameters);
    }
}
