<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Manager;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\Manager\SourceConditionManager;
use WideFocus\Feed\Source\Condition\SourceConditionCombinationInterface;
use WideFocus\Feed\Source\Condition\SourceConditionFactoryInterface;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Manager\SourceConditionManager
 */
class SourceConditionManagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return SourceConditionManager
     *
     * @covers ::__construct
     */
    public function testConstructor(): SourceConditionManager
    {
        return new SourceConditionManager(
            $this->createMock(SourceConditionFactoryInterface::class)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param SourceConditionManager $manager
     *
     * @return void
     *
     * @covers ::addConditionFactory
     * @covers ::createCondition
     */
    public function testCreateCondition(SourceConditionManager $manager)
    {
        $parameters = $this->createMock(SourceParametersInterface::class);

        $condition = $this->createMock(SourceConditionInterface::class);
        $factory   = $this->createMock(SourceConditionFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('createCondition')
            ->with($parameters)
            ->willReturn($condition);

        $manager->addConditionFactory($factory, 'foo');
        $this->assertEquals(
            $condition,
            $manager->createCondition('foo', $parameters)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param SourceConditionManager $manager
     *
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\Manager\InvalidSourceConditionException
     *
     * @covers ::createCondition
     */
    public function testCreateConditionException(SourceConditionManager $manager)
    {
        $parameters = $this->createMock(SourceParametersInterface::class);
        $manager->createCondition('not_existing', $parameters);
    }

    /**
     * @return void
     *
     * @covers ::__construct
     * @covers ::createCombinationCondition
     */
    public function testCreateCombinationCondition()
    {
        $parameters = $this->createMock(SourceParametersInterface::class);

        $condition = $this->createMock(SourceConditionCombinationInterface::class);
        $factory   = $this->createMock(SourceConditionFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('createCondition')
            ->with($parameters)
            ->willReturn($condition);

        $manager = new SourceConditionManager($factory);
        $this->assertEquals(
            $condition,
            $manager->createCombinationCondition($parameters)
        );
    }
}
