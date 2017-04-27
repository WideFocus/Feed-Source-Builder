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
 * Creates source conditions.
 */
interface SourceConditionFactoryInterface
{
    /**
     * Create a source condition.
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
}
