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
interface SourceConditionFactoryAggregateInterface
{
    /**
     * Create a condition.
     *
     * @param FeedConditionInterface $feedCondition
     * @param ParameterBagInterface  $sourceParameters
     *
     * @return SourceConditionInterface
     */
    public function create(
        FeedConditionInterface $feedCondition,
        ParameterBagInterface $sourceParameters
    ): SourceConditionInterface;

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
    );
}
