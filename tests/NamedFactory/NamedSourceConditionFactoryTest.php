<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\NamedFactory;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Builder\NamedFactory\NamedSourceConditionFactory;
use WideFocus\Feed\Source\Condition\SourceConditionCombinationInterface;
use WideFocus\Feed\Source\Condition\SourceConditionFactoryInterface;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\NamedFactory\NamedSourceConditionFactory
 */
class NamedSourceConditionFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return NamedSourceConditionFactory
     *
     * @covers ::__construct
     */
    public function testConstructor(): NamedSourceConditionFactory
    {
        return new NamedSourceConditionFactory(
            $this->createMock(SourceConditionFactoryInterface::class)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param NamedSourceConditionFactory $namedFactory
     *
     * @return void
     *
     * @covers ::addConditionFactory
     * @covers ::createCondition
     */
    public function testCreateCondition(NamedSourceConditionFactory $namedFactory)
    {
        $parameters = $this->createMock(SourceParametersInterface::class);

        $condition = $this->createMock(SourceConditionInterface::class);
        $factory   = $this->createMock(SourceConditionFactoryInterface::class);
        $factory
            ->expects($this->once())
            ->method('createCondition')
            ->with($parameters)
            ->willReturn($condition);

        $namedFactory->addConditionFactory($factory, 'foo');
        $this->assertEquals(
            $condition,
            $namedFactory->createCondition('foo', $parameters)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param NamedSourceConditionFactory $namedFactory
     *
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Builder\NamedFactory\InvalidSourceConditionException
     *
     * @covers ::createCondition
     */
    public function testCreateConditionException(NamedSourceConditionFactory $namedFactory)
    {
        $parameters = $this->createMock(SourceParametersInterface::class);
        $namedFactory->createCondition('not_existing', $parameters);
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

        $namedFactory = new NamedSourceConditionFactory($factory);
        $this->assertEquals(
            $condition,
            $namedFactory->createCombinationCondition($parameters)
        );
    }
}
