<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Condition\SourceConditionCombinationInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Builds source conditions based on feeds.
 */
interface SourceConditionBuilderInterface
{
    /**
     * Build a source condition based on a feed.
     *
     * @param FeedInterface             $feed
     * @param SourceParametersInterface $parameters
     *
     * @return SourceConditionCombinationInterface
     */
    public function buildConditions(
        FeedInterface $feed,
        SourceParametersInterface $parameters
    ): SourceConditionCombinationInterface;
}
