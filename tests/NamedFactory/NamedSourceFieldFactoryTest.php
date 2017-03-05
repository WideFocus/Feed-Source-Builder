<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\NamedFactory;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\NamedFactory\NamedSourceFieldFactory;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\Field\SourceFieldFactoryInterface;
use WideFocus\Feed\Source\Field\SourceFieldInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\NamedFactory\NamedSourceFieldFactory
 */
class NamedSourceFieldFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return NamedSourceFieldFactory
     *
     * @covers ::__construct
     */
    public function testConstructor(): NamedSourceFieldFactory
    {
        return new NamedSourceFieldFactory(
            $this->createMock(SourceFieldFactoryInterface::class)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param NamedSourceFieldFactory $namedFactory
     *
     * @return void
     *
     * @covers ::addFieldFactory
     * @covers ::createField
     */
    public function testCreateField(NamedSourceFieldFactory $namedFactory)
    {
        $parameters = $this->createMock(SourceParametersInterface::class);

        $field   = $this->createMock(SourceFieldInterface::class);
        $factory = $this->createMock(SourceFieldFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('createField')
            ->with($parameters)
            ->willReturn($field);

        $namedFactory->addFieldFactory($factory, 'foo');
        $this->assertEquals(
            $field,
            $namedFactory->createField('foo', $parameters)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param NamedSourceFieldFactory $namedFactory
     *
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\NamedFactory\InvalidSourceFieldException
     *
     * @covers ::createField
     */
    public function testCreateFieldException(NamedSourceFieldFactory $namedFactory)
    {
        $parameters = $this->createMock(SourceParametersInterface::class);
        $namedFactory->createField('not_existing', $parameters);
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

        $namedFactory = new NamedSourceFieldFactory($factory);
        $this->assertEquals(
            $field,
            $namedFactory->createCombinationField($parameters)
        );
    }
}
