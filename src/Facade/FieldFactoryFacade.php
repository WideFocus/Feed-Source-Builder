<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder\Facade;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Builder\Field\SourceFieldFactoryAggregateInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombination;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;

class FieldFactoryFacade implements FieldFactoryFacadeInterface
{
    /**
     * @var SourceFieldFactoryAggregateInterface
     */
    private $fieldFactory;

    /**
     * Constructor.
     *
     * @param SourceFieldFactoryAggregateInterface $fieldFactory
     */
    public function __construct(
        SourceFieldFactoryAggregateInterface $fieldFactory
    ) {
        $this->fieldFactory = $fieldFactory;
    }

    /**
     * Create a field combination for a feed.
     *
     * @param FeedInterface $feed
     *
     * @return SourceFieldCombinationInterface
     */
    public function create(FeedInterface $feed): SourceFieldCombinationInterface
    {
        $fields = [];
        foreach ($feed->getFields() as $feedField) {
            $fields[$feedField->getName()] = $this->fieldFactory->create(
                $feedField,
                $feed->getSourceParameters()
            );
        }

        return new SourceFieldCombination($fields);
    }
}
