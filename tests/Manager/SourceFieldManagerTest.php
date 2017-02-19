<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Manager;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\Manager\SourceFieldManager;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\Field\SourceFieldFactoryInterface;
use WideFocus\Feed\Source\Field\SourceFieldInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Manager\SourceFieldManager
 */
class SourceFieldManagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return SourceFieldManager
     *
     * @covers ::__construct
     */
    public function testConstructor(): SourceFieldManager
    {
        return new SourceFieldManager(
            $this->createMock(SourceFieldFactoryInterface::class)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param SourceFieldManager $manager
     *
     * @return void
     *
     * @covers ::addFieldFactory
     * @covers ::createField
     */
    public function testCreateField(SourceFieldManager $manager)
    {
        $parameters = $this->createMock(SourceParametersInterface::class);

        $field   = $this->createMock(SourceFieldInterface::class);
        $factory = $this->createMock(SourceFieldFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('createField')
            ->with($parameters)
            ->willReturn($field);

        $manager->addFieldFactory($factory, 'foo');
        $this->assertEquals(
            $field,
            $manager->createField('foo', $parameters)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param SourceFieldManager $manager
     *
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\Manager\InvalidSourceFieldException
     *
     * @covers ::createField
     */
    public function testCreateFieldException(SourceFieldManager $manager)
    {
        $parameters = $this->createMock(SourceParametersInterface::class);
        $manager->createField('not_existing', $parameters);
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

        $manager = new SourceFieldManager($factory);
        $this->assertEquals(
            $field,
            $manager->createCombinationField($parameters)
        );
    }
}
