<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Facade;

use WideFocus\Feed\Entity\FeedConditionInterface;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Builder\Condition\SourceConditionFactoryAggregateInterface;
use WideFocus\Feed\Source\Condition\SourceConditionCombination;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Validator\Logical\LogicalAndValidator;
use WideFocus\Validator\Logical\LogicalBoolValidator;

class ConditionFactoryFacade implements ConditionFactoryFacadeInterface
{
    /**
     * @var SourceConditionFactoryAggregateInterface
     */
    private $conditionFactory;

    /**
     * Constructor.
     *
     * @param SourceConditionFactoryAggregateInterface $conditionFactory
     */
    public function __construct(
        SourceConditionFactoryAggregateInterface $conditionFactory
    ) {
        $this->conditionFactory = $conditionFactory;
    }

    /**
     * Create a condition combination for a feed.
     *
     * @param FeedInterface $feed
     *
     * @return SourceConditionInterface
     */
    public function create(FeedInterface $feed): SourceConditionInterface
    {
        $conditions = array_map(
            function (FeedConditionInterface $condition) use ($feed) : SourceConditionInterface {
                return $this->conditionFactory->create(
                    $condition,
                    $feed->getSourceParameters()
                );
            },
            $feed->getConditions()
        );

        return new SourceConditionCombination(
            new LogicalAndValidator(
                new LogicalBoolValidator(true)
            ),
            ...$conditions
        );
    }
}
