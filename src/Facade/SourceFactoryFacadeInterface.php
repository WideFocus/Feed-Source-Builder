<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Facade;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorInterface;

interface SourceFactoryFacadeInterface
{
    /**
     * Create an iterator to iterate over a source.
     *
     * @param FeedInterface $feed
     *
     * @return SourceIteratorInterface
     */
    public function create(
        FeedInterface $feed
    ): SourceIteratorInterface;
}
