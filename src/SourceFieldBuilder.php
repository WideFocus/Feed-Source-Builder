<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder;

use WideFocus\Feed\Entity\Field\FeedFieldInterface;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Builder\FactoryAggregate\SourceFieldFactoryAggregateInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\Field\SourceFieldInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Builds source fields based on feeds.
 */
class SourceFieldBuilder implements SourceFieldBuilderInterface
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
    public function __construct(SourceFieldFactoryAggregateInterface $fieldFactory)
    {
        $this->fieldFactory = $fieldFactory;
    }

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
    ): SourceFieldCombinationInterface {
        $combination = $this->fieldFactory->createCombinationField($parameters);

        foreach ($feed->getFields() as $feedField) {
            $combination->addField(
                $this->createField($feedField, $parameters),
                $feedField->getLabel()
            );
        }

        return $combination;
    }

    /**
     * Build a source field based on a feed field.
     *
     * @param FeedFieldInterface        $feedField
     * @param SourceParametersInterface $parameters
     *
     * @return SourceFieldInterface
     */
    protected function createField(
        FeedFieldInterface $feedField,
        SourceParametersInterface $parameters
    ): SourceFieldInterface {
        $field = $this->fieldFactory->createField(
            $feedField->getType(),
            $parameters
        );

        $field->setAttributeCode($feedField->getName());
        return $field;
    }
}
