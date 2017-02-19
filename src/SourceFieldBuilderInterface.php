<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Builds source fields based on feeds.
 */
interface SourceFieldBuilderInterface
{
    /**
     * Build a source field based on a feed.
     *
     * @param FeedInterface             $feed
     * @param SourceParametersInterface $parameters
     *
     * @return SourceFieldCombinationInterface
     */
    public function buildFields(
        FeedInterface $feed,
        SourceParametersInterface $parameters
    ): SourceFieldCombinationInterface;
}
