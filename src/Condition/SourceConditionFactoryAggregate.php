<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Condition;

use WideFocus\Feed\Entity\FeedConditionInterface;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * Creates source conditions by name.
 */
class SourceConditionFactoryAggregate implements SourceConditionFactoryAggregateInterface
{
    /**
     * @var SourceConditionFactoryInterface[]
     */
    private $factories = [];

    /**
     * Create a condition.
     *
     * @param FeedConditionInterface $feedCondition
     * @param ParameterBagInterface  $sourceParameters
     *
     * @return SourceConditionInterface
     *
     * @throws InvalidSourceConditionException When the condition type has not
     *  been registered.
     */
    public function create(
        FeedConditionInterface $feedCondition,
        ParameterBagInterface $sourceParameters
    ): SourceConditionInterface {
        $type = $feedCondition->getType();
        if (!array_key_exists($type, $this->factories)) {
            throw new InvalidSourceConditionException($type);
        }

        return $this->factories[$type]
            ->create($feedCondition, $sourceParameters);
    }

    /**
     * Add a condition factory.
     *
     * @param string                          $type
     * @param SourceConditionFactoryInterface $factory
     *
     * @return void
     */
    public function addFactory(
        string $type,
        SourceConditionFactoryInterface $factory
    ) {
        $this->factories[$type] = $factory;
    }
}
