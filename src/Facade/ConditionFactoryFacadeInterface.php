<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Facade;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;

interface ConditionFactoryFacadeInterface
{
    /**
     * Create a condition combination for a feed.
     *
     * @param FeedInterface $feed
     *
     * @return SourceConditionInterface
     */
    public function create(FeedInterface $feed): SourceConditionInterface;
}
