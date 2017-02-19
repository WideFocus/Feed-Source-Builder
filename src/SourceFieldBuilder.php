<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder;

use WideFocus\Feed\Entity\Field\FeedFieldInterface;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Builder\Manager\SourceFieldManagerInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\Field\SourceFieldInterface;
use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Builds source fields based on feeds.
 */
class SourceFieldBuilder implements SourceFieldBuilderInterface
{
    /**
     * @var SourceFieldManagerInterface
     */
    private $fieldManager;

    /**
     * Constructor.
     *
     * @param SourceFieldManagerInterface $fieldManager
     */
    public function __construct(SourceFieldManagerInterface $fieldManager)
    {
        $this->fieldManager = $fieldManager;
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
        $combination = $this->fieldManager->createCombinationField($parameters);

        foreach ($feed->getFields() as $feedField) {
            $combination->addField(
                $this->createField($feedField, $parameters),
                $feedField->getName()
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
        $field = $this->fieldManager->createField(
            $feedField->getType(),
            $parameters
        );

        $field->setAttributeCode($feedField->getCode());
        return $field;
    }
}
