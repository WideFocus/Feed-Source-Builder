<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Facade;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Entity\FeedConditionInterface;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Builder\Condition\SourceConditionFactoryAggregateInterface;
use WideFocus\Feed\Source\Builder\Facade\ConditionFactoryFacade;
use WideFocus\Feed\Source\Condition\SourceConditionCombination;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Facade\ConditionFactoryFacade
 */
class ConditionFactoryFacadeTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            ConditionFactoryFacade::class,
            new ConditionFactoryFacade(
                $this->createMock(SourceConditionFactoryAggregateInterface::class)
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

        $feedConditions = [
            $this->createMock(FeedConditionInterface::class),
            $this->createMock(FeedConditionInterface::class)
        ];

        $conditions = [
            $this->createMock(SourceConditionInterface::class),
            $this->createMock(SourceConditionInterface::class)
        ];

        $feed = $this->createConfiguredMock(
            FeedInterface::class,
            [
                'getConditions' => $feedConditions,
                'getSourceParameters' => $sourceParameters
            ]
        );

        $conditionFactory = $this->createMock(
            SourceConditionFactoryAggregateInterface::class
        );

        foreach ($feedConditions as $key => $feedCondition) {
            $conditionFactory
                ->expects($this->at($key))
                ->method('create')
                ->with($feedCondition, $sourceParameters)
                ->willReturn($conditions[$key]);
        }

        $factory = new ConditionFactoryFacade($conditionFactory);
        $this->assertInstanceOf(
            SourceConditionCombination::class,
            $factory->create($feed)
        );
    }
}
