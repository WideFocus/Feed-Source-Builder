<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Builder\Manager\SourceParametersManagerInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Builds source parameters for feeds.
 */
class SourceParametersBuilder implements SourceParametersBuilderInterface
{
    /**
     * @var SourceParametersManagerInterface
     */
    private $parametersManager;

    /**
     * Constructor.
     *
     * @param SourceParametersManagerInterface $parametersManager
     */
    public function __construct(
        SourceParametersManagerInterface $parametersManager
    ) {
        $this->parametersManager = $parametersManager;
    }

    /**
     * Build a source parameters object for a feed.
     *
     * @param FeedInterface $feed
     *
     * @return SourceParametersInterface
     */
    public function buildParameters(
        FeedInterface $feed
    ): SourceParametersInterface {
        return $this->parametersManager
            ->createParameters(
                $feed->getSourceType(),
                iterator_to_array($feed->getSourceParameters())
            );
    }
}
