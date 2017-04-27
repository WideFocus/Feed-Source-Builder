<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Facade;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Builder\Source\IdentitySourceFactoryAggregateInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorFactoryInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorInterface;

class SourceFactoryFacade implements SourceFactoryFacadeInterface
{
    /**
     * @var SourceIteratorFactoryInterface
     */
    private $iteratorFactory;

    /**
     * @var IdentitySourceFactoryAggregateInterface
     */
    private $idSourceFactory;

    /**
     * @var ConditionFactoryFacadeInterface
     */
    private $conditionFactory;

    /**
     * @var FieldFactoryFacadeInterface
     */
    private $fieldFactory;

    /**
     * Constructor.
     *
     * @param SourceIteratorFactoryInterface          $iteratorFactory
     * @param IdentitySourceFactoryAggregateInterface $idSourceFactory
     * @param ConditionFactoryFacadeInterface         $conditionFactory
     * @param FieldFactoryFacadeInterface             $fieldFactory
     */
    public function __construct(
        SourceIteratorFactoryInterface $iteratorFactory,
        IdentitySourceFactoryAggregateInterface $idSourceFactory,
        ConditionFactoryFacadeInterface $conditionFactory,
        FieldFactoryFacadeInterface $fieldFactory
    ) {
        $this->iteratorFactory  = $iteratorFactory;
        $this->idSourceFactory  = $idSourceFactory;
        $this->conditionFactory = $conditionFactory;
        $this->fieldFactory     = $fieldFactory;
    }

    /**
     * Create an iterator to iterate over a source.
     *
     * @param FeedInterface $feed
     *
     * @return SourceIteratorInterface
     */
    public function create(
        FeedInterface $feed
    ): SourceIteratorInterface {
        return $this->iteratorFactory->create(
            $this->idSourceFactory->create(
                $feed->getSourceType(),
                $feed->getSourceParameters()
            ),
            $this->conditionFactory->create($feed),
            $this->fieldFactory->create($feed)
        );
    }
}
