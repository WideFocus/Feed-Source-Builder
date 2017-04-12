<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Builder\FactoryAggregate\SourceParametersFactoryAggregateInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Builds source parameters for feeds.
 */
class SourceParametersBuilder implements SourceParametersBuilderInterface
{
    /**
     * @var SourceParametersFactoryAggregateInterface
     */
    private $parametersFactory;

    /**
     * Constructor.
     *
     * @param SourceParametersFactoryAggregateInterface $parametersFactory
     */
    public function __construct(
        SourceParametersFactoryAggregateInterface $parametersFactory
    ) {
        $this->parametersFactory = $parametersFactory;
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
        return $this->parametersFactory
            ->createParameters(
                $feed->getSourceType(),
                iterator_to_array($feed->getSourceParameters())
            );
    }
}
