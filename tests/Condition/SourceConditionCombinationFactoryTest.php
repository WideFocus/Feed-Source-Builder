<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Tests\Condition;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Entity\FeedConditionInterface;
use WideFocus\Feed\Source\Builder\Condition\SourceConditionCombinationFactory;
use WideFocus\Feed\Source\Builder\Condition\SourceConditionFactoryAggregateInterface;
use WideFocus\Feed\Source\Builder\Validator\ValidatorFactoryAggregateInterface;
use WideFocus\Feed\Source\Condition\SourceConditionCombination;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Parameters\ParameterBagInterface;
use WideFocus\Validator\ValidatorInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Builder\Condition\SourceConditionCombinationFactory
 */
class SourceConditionCombinationFactoryTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            SourceConditionCombinationFactory::class,
            new SourceConditionCombinationFactory(
                $this->createMock(
                    SourceConditionFactoryAggregateInterface::class
                ),
                $this->createMock(
                    ValidatorFactoryAggregateInterface::class
                )
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
        $constraints      = $this->createMock(ParameterBagInterface::class);

        $children = [
            $this->createMock(FeedConditionInterface::class),
            $this->createMock(FeedConditionInterface::class)
        ];

        $conditions = [
            $this->createMock(SourceConditionInterface::class),
            $this->createMock(SourceConditionInterface::class)
        ];

        $feedCondition = $this->createMock(FeedConditionInterface::class);
        $feedCondition
            ->expects($this->once())
            ->method('getChildren')
            ->willReturn($children);

        $feedCondition
            ->expects($this->once())
            ->method('getOperator')
            ->willReturn('foo_validator');

        $feedCondition
            ->expects($this->once())
            ->method('getConstraints')
            ->willReturn($constraints);

        $conditionFactory = $this->createMock(
            SourceConditionFactoryAggregateInterface::class
        );

        foreach ($children as $key => $child) {
            $conditionFactory
                ->expects($this->at($key))
                ->method('create')
                ->with($child, $sourceParameters)
                ->willReturn($conditions[$key]);
        }

        $validatorFactory = $this->createMock(
            ValidatorFactoryAggregateInterface::class
        );

        $validatorFactory
            ->expects($this->once())
            ->method('create')
            ->with('foo_validator', $constraints)
            ->willReturn($this->createMock(ValidatorInterface::class));

        $factory = new SourceConditionCombinationFactory(
            $conditionFactory,
            $validatorFactory
        );

        $this->assertInstanceOf(
            SourceConditionCombination::class,
            $factory->create($feedCondition, $sourceParameters)
        );
    }
}
