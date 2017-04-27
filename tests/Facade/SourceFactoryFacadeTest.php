<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Facade;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Builder\Facade\ConditionFactoryFacadeInterface;
use WideFocus\Feed\Source\Builder\Facade\FieldFactoryFacadeInterface;
use WideFocus\Feed\Source\Builder\Facade\SourceFactoryFacade;
use WideFocus\Feed\Source\Builder\Source\IdentitySourceFactoryAggregateInterface;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\IdentitySourceInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorFactoryInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Facade\SourceFactoryFacade
 */
class SourceFactoryFacadeTest extends TestCase
{

    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            SourceFactoryFacade::class,
            new SourceFactoryFacade(
                $this->createMock(SourceIteratorFactoryInterface::class),
                $this->createMock(IdentitySourceFactoryAggregateInterface::class),
                $this->createMock(ConditionFactoryFacadeInterface::class),
                $this->createMock(FieldFactoryFacadeInterface::class)
            )
        );
    }

    /**
     * @return void
     *
     * @covers ::create
     */
    public function testCreate()
    {
        $sourceParameters = $this->createMock(ParameterBagInterface::class);

        $feed = $this->createConfiguredMock(
            FeedInterface::class,
            [
                'getSourceType' => 'foo',
                'getSourceParameters' => $sourceParameters
            ]
        );

        $source          = $this->createMock(IdentitySourceInterface::class);
        $idSourceFactory = $this->createMock(IdentitySourceFactoryAggregateInterface::class);
        $idSourceFactory
            ->expects($this->once())
            ->method('create')
            ->with('foo', $sourceParameters)
            ->willReturn($source);

        $condition        = $this->createMock(SourceConditionInterface::class);
        $conditionFactory = $this->createMock(ConditionFactoryFacadeInterface::class);
        $conditionFactory
            ->expects($this->once())
            ->method('create')
            ->with($feed)
            ->willReturn($condition);

        $field        = $this->createMock(SourceFieldCombinationInterface::class);
        $fieldFactory = $this->createMock(FieldFactoryFacadeInterface::class);
        $fieldFactory
            ->expects($this->once())
            ->method('create')
            ->with($feed)
            ->willReturn($field);

        $iterator        = $this->createMock(SourceIteratorInterface::class);
        $iteratorFactory = $this->createMock(SourceIteratorFactoryInterface::class);
        $iteratorFactory
            ->expects($this->once())
            ->method('create')
            ->with($source, $condition, $field)
            ->willReturn($iterator);

        $factory = new SourceFactoryFacade(
            $iteratorFactory,
            $idSourceFactory,
            $conditionFactory,
            $fieldFactory
        );

        $this->assertSame($iterator, $factory->create($feed));
    }
}
