<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorInterface;

interface SourceIteratorBuilderInterface
{
    /**
     * Build a source iterator for a feed entity.
     *
     * @param FeedInterface $feed
     *
     * @return SourceIteratorInterface
     */
    public function buildIterator(
        FeedInterface $feed
    ): SourceIteratorInterface;
}