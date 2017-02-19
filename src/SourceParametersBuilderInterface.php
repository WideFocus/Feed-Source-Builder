<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Builds source parameters for feeds.
 */
interface SourceParametersBuilderInterface
{
    /**
     * Build a source parameters object for a feed.
     *
     * @param FeedInterface $feed
     *
     * @return SourceParametersInterface
     */
    public function buildParameters(
        FeedInterface $feed
    ): SourceParametersInterface;
}